<?php

include "vendor/autoload.php";

use LeonardoBarcelos\PhpSocketRS;

if (count($argv) < 3)  {
    echo "Error:\n";
    echo "\tUsage: php server.php {serverIp}:{port=32150} {nickName} [{withoutSound}]\n";
    exit();
}

$ipAndPort = explode(':', $argv[1]);
if (count($ipAndPort) > 1) {
    list($ip, $port) = $ipAndPort;
} else {
    $ip = $ipAndPort[0];
    $port = 32150;
}

$server = new PhpSocketRS\ServerSocket($ip, $port);

echo "Aguardando Fulano...\n";
$chat = $server->accept();

$withSound = true;
if (!empty($argv[3])) {
    $withSound = false;
}

echo "Conexão estabelecida com ". $chat->getName() ."\n";

$userIn = fopen('php://stdin', 'r');
echo "[$argv[2]]: ";

$chatOn = true;
while ($chatOn) {
    $streamsToRead = [$chat->getSocket(), $userIn];
    $streamsToWrite = null;
    $streamsToExcept = null;

    if ( 0 < stream_select($streamsToRead, $streamsToWrite, $streamsToExcept, null)) {
        foreach ($streamsToRead as $i => $socket) {
            if ($socket == $userIn) {
                $message = fgets($userIn);
                $message = str_replace("\n", "", $message);
                $foundCommand = trim($message);
                if ( strpos($foundCommand, "\\clear") !== false) {
                    print shell_exec("clear");
                } else {
                    $chat->write("[$argv[2]]: " . $message . "\n");
                }
            } else {
                $text = $chat->getLastLine();
                if ($text == "") {
                    echo "Chat fechado!\n";
                    $chatOn  = false;
                    unset($chat);
                    break;
                }
                !$withSound ?: shell_exec("mpg321 resources/sounds/message_received.mp3 -q");
                echo "\r\033[2K" . $text;
            }
            echo "[$argv[2]]: ";
        }
    }
}

unset($server);
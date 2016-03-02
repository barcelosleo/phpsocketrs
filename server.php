<?php

include "vendor/autoload.php";

use LeonardoBarcelos\PhpSocketRS;

$server = new PhpSocketRS\ServerSocket('192.168.0.33', 32150);

echo "Aguardando Fulano...\n";
$chat = $server->accept();

echo "Conexão estabelecida com ". $chat->getName() ."\n";

$userIn = fopen('php://stdin', 'r');
echo "[$argv[1]]: ";

$chatOn = true;
while ($chatOn) {
    $streamsToRead = [$chat->getSocket(), $userIn];
    $streamsToWrite = null;
    $streamsToExcept = null;

    if ( 0 < stream_select($streamsToRead, $streamsToWrite, $streamsToExcept, null)) {
        foreach ($streamsToRead as $i => $socket) {
            if ($socket == $userIn) {
                $chat->write("[$argv[1]]: " . fgets($userIn));
//                fwrite($chat->getSocket(), );
            } else {
                $text = $chat->getLastLine();
                if ($text == "") {
                    echo "Chat fechado!\n";
                    $chatOn  = false;
                    unset($chat);
                    break;
                }
                echo "\n" . $text;
            }
            echo "[$argv[1]]: ";
        }
    }
}

unset($server);
<?php

include "vendor/autoload.php";

use LeonardoBarcelos\PhpSocketRS;

if (count($argv) < 3)  {
    echo "Error:\n";
    echo "\tUsage: php client.php {serverIp} {nickName}\n";
    exit();
}

$chat = new PhpSocketRS\ClientSocket($argv[1], 32150);

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
                $chat->write("[$argv[2]]: " . fgets($userIn));
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
            echo "[$argv[2]]: ";
        }
    }
}

unset($chat);
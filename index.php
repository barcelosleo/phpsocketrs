<?php

include "vendor/autoload.php";

use LeonardoBarcelos\PhpSocketRS;

try {
//    $socketClient = new PhpSocketRS\ClientSocket(gethostbyname('www.google.com'), 80);
    $socketClient = new PhpSocketRS\ClientSocket('127.0.0.1', 32150);

    $httpRequest = new PhpSocketRS\Get();
    $httpRequest->setPath('/');
    $httpRequest->setHeaders([
        'User-Agent' => 'PhpSocketRS/1.0',
        'Accept' => '*/*',
        'Host' => $socketClient->getHost()
    ]);
    echo "--------------------------------- Requisição ---------------------------------\n";
    echo $httpRequest->getSocketMessage();
    echo "--------------------------------- Requisição ---------------------------------\n";
    $socketClient->writeSocketMessage($httpRequest);
    echo "--------------------------------- Resposta ---------------------------------\n";
    echo $socketClient->getResponse();
    echo "--------------------------------- Resposta ---------------------------------\n";
//    $httpResponse = new PhpSocketRS\HttpResponse();
//    $httpResponse->translate($socketClient->getResponse());
//    echo $httpResponse->getCode() . "\n";
//    echo $httpResponse->getHttpVersion() . "\n";
//    echo $httpResponse->getMessage() . "\n";
//    print_r($httpResponse->getHeaders());
} catch (PhpSocketRS\SocketException $e) {
    echo "{$e->getCode()}: {$e->getMessage()}\n";
}


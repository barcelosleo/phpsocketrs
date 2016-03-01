<?php

include "vendor/autoload.php";

use LeonardoBarcelos\PhpSocketRS;

$test = new PhpSocketRS\Socket();
try {
    $test->connect('127.0.0.1', 80);

} catch (PhpSocketRS\SocketException $e) {
    echo "{$e->getCode()}: {$e->getMessage()}\n";
}

$httpreq = new PhpSocketRS\Get();
$httpreq->setPath("/");
$httpreq->setHeaders([
    'User-Agent' => 'PhpSocketRS/1.0',
    'Connection' => 'Keep-Alive',
    'Accept-Encoding' => 'gzip, deflate',
    'Host' => 'localhost'
]);
echo $httpreq->getRequestMessage();

try {
    $test->send($httpreq);
    echo $test->response();
} catch (PhpSocketRS\SocketException $e) {
    echo "{$e->getCode()}: {$e->getMessage()}\n";
}
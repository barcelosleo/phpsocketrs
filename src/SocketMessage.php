<?php namespace LeonardoBarcelos\PhpSocketRS;


interface SocketMessage
{
    public function getSocketMessage();
    public function getSocketMessageSize();
    public function getSocketFlags();
}
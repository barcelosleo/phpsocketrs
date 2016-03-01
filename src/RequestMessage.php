<?php namespace LeonardoBarcelos\PhpSocketRS;


interface RequestMessage
{
    public function getRequestMessage();
    public function getRequestSize();
    public function getRequestFlags();
}
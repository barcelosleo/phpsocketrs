<?php namespace LeonardoBarcelos\PhpSocketRS;

/**
 * Class SocketException
 * @package Socket
 */
class SocketException extends \Exception
{
    public function __construct($message, $code, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
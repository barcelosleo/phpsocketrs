<?php namespace LeonardoBarcelos\PhpSocketRS;

/**
 * Class SocketException
 * @package Socket
 */
class SocketException extends \Exception
{
    public function __construct($socketLastError)
    {
        $code = $socketLastError;
        $message = socket_strerror($code);
        parent::__construct($message, $code, null);
    }
}
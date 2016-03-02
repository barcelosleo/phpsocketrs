<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 02/03/16
 * Time: 13:37
 */

namespace LeonardoBarcelos\PhpSocketRS;


class ServerSocket extends Socket
{
    public function __construct($host = null, $port = null, $protocol = null)
    {
        parent::__construct($host, $port, $protocol);
    }

    public function create()
    {
        if(!($this->socket = stream_socket_server(
            "{$this->protocol}://{$this->host}:{$this->port}",
            $errorCode,
            $errorString
        ))) {
            throw new SocketException($errorString, $errorCode);
        }
        if ($this->verbose) {
            echo "Server Socket created..\n";
        }
    }

    public function accept()
    {
        $client = new ClientSocket();
        $client->setSocket(stream_socket_accept($this->socket));
        return $client;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 02/03/16
 * Time: 10:24
 */

namespace LeonardoBarcelos\PhpSocketRS;


class ClientSocket extends Socket
{
    /**
     * @inheritdoc
     */
    public function __construct($host = null, $port = null, $protocol = null)
    {
        parent::__construct($host, $port, $protocol);
    }

    /**
     * @inheritdoc
     */
    protected function create()
    {
        if (!($this->socket = stream_socket_client(
            "{$this->protocol}://{$this->host}:{$this->port}",
            $errorNumber,
            $errorString
        ))) {
            throw new SocketException($errorString, $errorNumber);
        }
        if ($this->verbose) {
            echo "Client Socket created..\n";
        }
    }

    public function accept()
    {
        $client = new ServerSocket();
        $client->setSocket(@stream_socket_accept($this->socket));
        return $client;
    }
}
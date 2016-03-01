<?php namespace LeonardoBarcelos\PhpSocketRS;

/**
 * Class Socket
 * @package Socket
 */
class Socket
{
    /**
     * @var $socket Variável onde será criado o socket
     */
    private $socket;
    /**
     * @var bool
     */
    private $verbose = true;

    /**
     * Socket constructor.
     */
    public function __construct()
    {
        $this->create();
    }

    /**
     * Socket destructor
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Método que cria o socket
     * @throws SocketException
     */
    private function create()
    {
        if (!($this->socket = stream_socket_client())) {
            throw new SocketException(socket_last_error($this-$this->socket));
        }
        if ($this->verbose) {
            echo "Socket created..\n";
        }
    }

    /**
     * Método que fecha o socket
     */
    private function close()
    {
        socket_close($this->socket);
        if ($this->verbose) {
            echo "Socket destroyed..\n";
        }
    }

    /**
     * Método que realiza uma conexão
     * @param $host
     * @param $port
     * @throws SocketException
     */
    public function connect($host, $port)
    {
        if (!socket_connect($this->socket, $host, $port)) {
            throw new SocketException(socket_last_error($this->socket));
        }
        if ($this->verbose) {
            echo "Connection stablished to {$host}:{$port}..\n";
        }
    }

    public function send(RequestMessage $request)
    {
        socket_send($this->socket, $request->getRequestMessage(), $request->getRequestSize(), $request->getRequestFlags());
    }

    public function response()
    {
        if (socket_recv($this->socket, $response, 2045, MSG_WAITALL) === false) {
            throw new SocketException(socket_last_error($this->socket));
        }
        return $response;
    }

    public function bind($host, $port)
    {
        if (!socket_bind($this->socket, $host, $port)) {
            throw new SocketException(socket_last_error($this->socket));
        }
    }

    public function listen($host, $port)
    {
        if (!socket_listen($this->socket)) {
            throw new SocketException(socket_last_error($this->socket));
        }
    }

    public function accept()
    {
        if (!socket_accept($this->socket)) {
            throw new SocketException(socket_last_error($this->socket));
        }
    }

    public function read($bufferSize = 1024)
    {
        if (!($response = socket_read($this->socket, $bufferSize))) {
            throw new SocketException(socket_last_error($this->socket));
        }
        return $response;
    }

    public function write(RequestMessage $request)
    {
        if (!socket_write($this->socket, $request->getRequestMessage(), $request->getRequestSize(), $request->getRequestFlags())) {
            throw new SocketException(socket_last_error($this->socket));
        }
    }
}
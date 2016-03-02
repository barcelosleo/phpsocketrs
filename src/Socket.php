<?php namespace LeonardoBarcelos\PhpSocketRS;

/**
 * Class Socket
 * @package Socket
 */
abstract class Socket
{
    /**
     * @var $socket Variável onde será criado o socket
     */
    protected $socket;

    /**
     * @var $lastResponse Última resposta do socket
     */
    protected $lastResponse;

    /**
     * @var bool
     */
    protected $verbose = true;

    /**
     * @var string Protocolo da requisição
     */
    protected $protocol = 'tcp';

    /**
     * @var string Host para onde serão enviadas as requisições
     */
    protected $host;

    /**
     * @var string Porta do host onde serão enviadas as requisições
     */
    protected $port;

    /**
     * @var int Número de segundos para timeout
     */
    protected $timeOut;

    /**
     * @var mixed Flags para socket
     */
    protected $flags;

    /**
     * @var mixed Context criado a partir de stream_context_create()
     */
    protected $context;

    /**
     * Socket constructor.
     * @param null $host
     * @param null $port
     * @param null $protocol
     */
    public function __construct($host = null, $port = null, $protocol = null)
    {
        $this->host = $host;
        $this->port = $port;
        $this->protocol = $protocol ? $protocol : $this->protocol;
        if ($host && $port) {
            $this->create();
        }
    }

    /**
     * Socket destructor
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * @return Variável
     */
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * @param Variável $socket
     */
    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return int
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * @param int $timeOut
     */
    public function setTimeOut($timeOut)
    {
        $this->timeOut = $timeOut;
    }

    /**
     * @return mixed
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param mixed $flags
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
    }

    /**
     * @return mixed
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param mixed $context
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    /**
     * Método que cria o socket
     * @throws SocketException
     */
    abstract protected function create();

    /**
     * Método que fecha o socket
     */
    protected function close()
    {
        fclose($this->socket);
        if ($this->verbose) {
            echo "Socket destroyed..\n";
        }
    }

    /**
     * Método que retorna o conteúdo da resposta do socket
     * @return string
     */
    public function getResponse()
    {
        $response = null;
        if ($this->lastResponse) {
            $response = $this->lastResponse;
            $this->lastResponse = null;
            return $response;
        }
        return $this->lastResponse = stream_get_contents($this->socket);
    }

    public function writeSocketMessage(SocketMessage $request)
    {
        fwrite($this->socket, $request->getSocketMessage(), $request->getSocketMessageSize());
    }

    public function write($content)
    {
        fwrite($this->socket, $content);
    }

    public function accept()
    {
        return stream_socket_accept($this->socket);
    }

    public function copyStream(Socket $sourceStream)
    {
        stream_copy_to_stream($sourceStream->getSocket(), $this->socket);
    }

    public function getName()
    {
        return stream_socket_get_name($this->socket, true);
    }
}
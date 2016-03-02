<?php namespace LeonardoBarcelos\PhpSocketRS;


class Get extends HttpRequest implements SocketMessage
{
    private $requestMessage;
    public function __construct()
    {
        parent::__construct();
    }

    public function getSocketMessage()
    {
        $this->requestMessage = "{$this->getMethod()} {$this->getPath()} {$this->getHttpVersion()}";
        $this->requestMessage .= "\r\n";
        $this->requestMessage .= $this->headersFormat();
        $this->requestMessage .= "\r\n";
        $this->requestMessage .= $this->getBody();
        $this->requestMessage .= "\r\n\r\n";
        return $this->requestMessage;
    }
    public function getSocketMessageSize()
    {
        return strlen($this->requestMessage);
    }
    public function getSocketFlags()
    {
        return 0;
    }
}
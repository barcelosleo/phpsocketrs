<?php namespace LeonardoBarcelos\PhpSocketRS;


class Get extends HttpRequest implements RequestMessage
{
    private $requestMessage;
    public function __construct()
    {
        parent::__construct();
    }

    public function getRequestMessage()
    {
        $this->requestMessage = "{$this->getMethod()} {$this->getPath()} {$this->getHttpVersion()}";
        $this->requestMessage .= "\r\n";
        $this->requestMessage .= $this->headersFormat();
        $this->requestMessage .= "\r\n";
        $this->requestMessage .= $this->getBody();
        return $this->requestMessage;
    }
    public function getRequestSize()
    {
        return strlen($this->requestMessage);
    }
    public function getRequestFlags()
    {
        return 0;
    }
}
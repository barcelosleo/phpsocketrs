<?php namespace LeonardoBarcelos\PhpSocketRS;


abstract class HttpRequest
{
    /**
     * Versão do HTTP
     * @var string
     */
    private $httpVersion = "HTTP/1.1";

    /**
     * @var $method Método de requisição
     */
    private $method;

    /**
     * @var $header Cabeçalhos da requisição
     */
    private $headers;

    /**
     * @var $path Path da requisição
     */
    private $path;

    /**
     * @var $body Corpo da requisição
     */
    private $body;

    /**
     * HttpRequest constructor
     */
    public function __construct()
    {
        $this->method = strtoupper((new \ReflectionClass($this))->getShortName());
    }

    /**
     * @return Método
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param Método $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return Cabeçalhos
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param Cabeçalhos $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return Corpo
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param Corpo $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return Path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param Path $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getHttpVersion()
    {
        return $this->httpVersion;
    }

    /**
     * @param string $version
     */
    public function setHttpVersion($httpVersion)
    {
        $this->httpVersion = $httpVersion;
    }

    /**
     * Método que adiciona um HEADER à requisição
     * @param $header
     * @param $value
     */
    public function addHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    /**
     * Método que retorna o valor do header
     * @param $header
     * @return mixed
     */
    public function getHeader($header)
    {
        return $this->headers[$header];
    }

    public function headerFormat($header)
    {
        return "{$header}: {$this->headers[$header]}";
    }
    public function headersFormat()
    {
        $out = '';
        foreach ($this->headers as $key => $value) {
            $out .= $this->headerFormat($key);
            $out .= "\r\n";
        }
        return $out;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 02/03/16
 * Time: 10:55
 */

namespace LeonardoBarcelos\PhpSocketRS;


abstract class Http
{
    /**
     * Versão do HTTP
     * @var string
     */
    protected $httpVersion = "HTTP/1.1";

    /**
     * @var $method Método de requisição
     */
    protected $method;

    /**
     * @var $header Cabeçalhos da requisição
     */
    protected $headers;

    /**
     * @var $body Corpo da requisição
     */
    protected $body;

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
     * @return string
     */
    public function getHttpVersion()
    {
        return $this->httpVersion;
    }

    /**
     * @param string $httpVersion
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

    /**
     * Método que formata um HEADER
     * @param $header
     * @return string
     */
    public function headerFormat($header)
    {
        return "{$header}: {$this->headers[$header]}";
    }

    /**
     * Método que formata a lista de HEADERS
     * @return string
     */
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
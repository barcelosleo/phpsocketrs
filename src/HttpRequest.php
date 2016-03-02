<?php namespace LeonardoBarcelos\PhpSocketRS;


abstract class HttpRequest extends Http
{
    /**
     * @var $path Path da requisição
     */
    protected $path;

    /**
     * HttpRequest constructor
     */
    public function __construct()
    {
        $this->method = strtoupper((new \ReflectionClass($this))->getShortName());
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
}
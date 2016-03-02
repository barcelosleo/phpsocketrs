<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 02/03/16
 * Time: 11:01
 */

namespace LeonardoBarcelos\PhpSocketRS;


class HttpResponse extends Http
{
    /**
     * Código de resposta. Ex.: 302
     * @var
     */
    protected $code;

    /**
     * Mensagem de acordo com o código de resposta
     * @var
     */
    protected $message;

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function __construct()
    {

    }

    public function translate($responseMessage)
    {
        $lines = explode("\r\n", $responseMessage);
        $responseFirstLine = array_shift($lines);
        $responseFirstLine = explode(' ', $responseFirstLine);
        $this->setHttpVersion(array_shift($responseFirstLine));
        $this->setCode(array_shift($responseFirstLine));
        $this->setMessage(implode(' ', $responseFirstLine));
        unset($responseFirstLine);
        if (isset($lines[0])) {
            while ($lines[0] != "") {
                $line = array_shift($lines);
                list($header, $value) = explode(": ", $line);
                $this->addHeader($header, $value);
            }
            array_shift($lines);
            if (isset($lines[0])) {
                while ($lines[0] != "") {
                    $line = array_shift($lines);
                    $this->body .= $line;
                }
            }
        }
    }
}
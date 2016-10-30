<?php
/**
 * Make Curl from incoming request
 *
 * @package Osadchyi\IncomingCurl
 * @version 0.1
 */
namespace Osadchyi;

use Illuminate\Http\Request;

class IncomingCurl
{
    const CURL_COMMAND = 'curl -X';

    protected $request;
    protected $headers;
    protected $method;
    protected $body;
    protected $url;

    public function __construct()
    {
        $this->setRequest( Request::createFromGlobals() )->parseRequest();
    }

    /**
     * Fast method for create curl command from globals
     *
     * @return string
     */
    public static function makeCurlFromGlobals()
    {
        return (new self)->makeCurlCommandLine();
    }

    /**
     * Make plain curl command
     *
     * @return string
     */
    public function makeCurlCommandLine()
    {
        $curlCommand = self::CURL_COMMAND . ' '.$this->getMethod();
        $headers = $this->getHeaders();
        if (!empty($headers) && count($headers)) {
            foreach ($headers as $name => $header) {
                if ($header[0]) {
                    $curlCommand.= ' -H "'. ucwords($name) .': '.$header[0].'"';
                }
            }
        }
        if ($this->getBody()) {
            $curlCommand.= ' -d \'' . $this->getBody() . '\'';
        }
        $curlCommand.= ' "'. $this->getUrl() .'"';

        return $curlCommand;
    }

    public function parseRequest() //Request $request
    {
        $request =  $this->getRequest();
        $this->setBody($request->getContent());
        $this->setHeaders($request->header());
        $this->setMethod($request->method());
        $this->setUrl($request->fullUrl());
        return $this;
    }
    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
}

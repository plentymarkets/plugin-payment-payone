<?php

namespace PayoneApi\Api;

/**
 * Class Client
 */
class Client implements ClientContract
{
    /**
     * @var  string
     */
    protected $url;
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;
    /**
     * @var  string
     */
    protected $httpMethod;
    /**
     * @var  string[]
     */
    protected $headers;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \GuzzleHttp\Client $client
     *
     * @return Client
     */
    public function setClient(\GuzzleHttp\Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @param string $httpMethod
     *
     * @return Client
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndpointUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Client
     */
    public function setEndpointUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function doRequest($data)
    {
        $res = $this->client->request(
            $this->getHttpMethod(),
            $this->getEndpointUrl(),
            [
                'form_params' => $data,
                'headers' => $this->headers,
            ]
        );

        return (string) $res->getBody();
    }

    /**
     * @param string $method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->httpMethod = $method;

        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function addHeader($key, $value)
    {
        if (!$this->headers) {
            $this->headers = [];
        }
        $this->headers[$key] = $value;
    }
}

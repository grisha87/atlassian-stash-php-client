<?php

namespace Atlassian\Stash\Api;

/**
 * Request representation
 */
class Request
{
    const METHOD_GET = 'GET';

    const METHOD_PUT = 'PUT';

    const METHOD_POST = 'POST';

    const METHOD_DELETE = 'DELETE';

    /** @var string The HTTP method to use */
    protected $method;

    /** @var string The URL to call */
    protected $url;

    /** @var array The payload that will be sent with the request */
    protected $payload = [];

    /**
     * @param string $method  The HTTP method to use within the request
     * @param string $url     The URL to call (resource)
     * @param array  $payload The array of parameters to pass with the request
     */
    public function __construct(string $method, string $url, array $payload = [])
    {
        $this->method = $method;
        $this->url    = $url;
        $this->params = $payload;
    }

    /**
     * @return string The HTTP method that will be used for the request
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string The URL that will be used in the request
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array The array of parameters sent with the request
     */
    public function getPayload(): array
    {
        return $this->params;
    }

    /**
     * @param string $name The name of the parameter
     *
     * @return mixed The value of the parameter from the payload
     */
    public function getParam(string $name)
    {
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        }
    }
}

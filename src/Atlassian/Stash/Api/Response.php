<?php

namespace Atlassian\Stash\Api;

use Psr\Http\Message\ResponseInterface;

/**
 * General API response representation
 */
class Response
{
    /** @var ResponseInterface */
    protected $guzzleResponse;

    /** @var mixed */
    protected $payload;

    /**
     * Response constructor.
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->guzzleResponse = $response;

        $contents = $response->getBody()->getContents();

        if (!empty($contents)) {
            $this->payload = \GuzzleHttp\json_decode($contents, true);
        }
    }

    /**
     * @return int The response code
     */
    public function getStatusCode(): int
    {
        return $this->guzzleResponse->getStatusCode();
    }

    /**
     * @return mixed The payload from the request
     */
    public function getPayload()
    {
        return $this->payload;
    }

    public function isPaged()
    {
        return array_key_exists('values', $this->payload)
            && array_key_exists('isLastPage', $this->payload);
    }

    public function isError()
    {
        return array_key_exists('errors', $this->payload);
    }

    public function isMessage()
    {
        return array_key_exists('exceptionName', $this->payload)
            && array_key_exists('message', $this->payload)
            && array_key_exists('context', $this->payload);
    }
}

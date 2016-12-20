<?php

namespace Atlassian\Stash\Api;

use Psr\Http\Message\ResponseInterface;

/**
 * General API response representation
 *
 * This class has been created to wrap around Guzzle response and provide
 * simpler API instead.
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

        $this->payload = $this->extractPayload();
    }

    /**
     * @return array The extracted payload
     */
    protected function extractPayload(): array
    {
        $contents = $this->guzzleResponse->getBody()->getContents();

        if (!empty($contents)) {
            $payload = \GuzzleHttp\json_decode($contents, true);

            return $payload;
        }

        return [];
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

    /**
     * Checks if the response is a page response
     * @return bool
     */
    public function isPaged(): bool
    {
        return array_key_exists('values', $this->payload)
            && array_key_exists('isLastPage', $this->payload)
            && array_key_exists('size', $this->payload);
    }

    /**
     * Checks if the response is an error response
     *
     * @return bool
     */
    public function isError(): bool
    {
        return array_key_exists('errors', $this->payload);
    }

    /**
     * Checks if the response is a message response
     *
     * @return bool
     */
    public function isMessage(): bool
    {
        return array_key_exists('exceptionName', $this->payload)
            && array_key_exists('message', $this->payload)
            && array_key_exists('context', $this->payload);
    }
}

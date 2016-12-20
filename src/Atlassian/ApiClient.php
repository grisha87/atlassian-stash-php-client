<?php

namespace Atlassian;

use Atlassian\Stash\Api\Response;
use Atlassian\Stash\Api\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

abstract class ApiClient
{
    /** @var Client The HTTP client that we're going to use for connections */
    protected $httpClient;

    /** @var string The base URL to BitBucket server */
    protected $baseUrl;

    /** @var string The user to authenticate as */
    protected $user;

    /** @var string The password to use in order to authenticate */
    protected $password;

    /** @var array Some default options for the client */
    protected $opts;

    /**
     * The stash client
     *
     * @param string $url
     * @param string $user
     * @param string $pass
     */
    public function __construct(string $url, string $user = null, string $pass = null)
    {
        $this->baseUrl  = $url;
        $this->user     = $user;
        $this->password = $pass;

        $this->httpClient = new Client([
            'base_uri' => $this->baseUrl,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    protected function sendRequest(Request $request): Response
    {
        // Prepare data for Guzzle...

        try {
            $reqMethod = $request->getMethod();
            $reqUri    = $this->buildUrlForRequest($request);
            $reqParams = array_merge_recursive(
                $this->buildBasicRequestOptions(),
                $this->buildRequestOptionsForRequest($request)
            );

            $guzzleResponse = $this->httpClient->request($reqMethod, $reqUri, $reqParams);

            return new Response($guzzleResponse);
        } catch (ClientException $clientException) {
            return new Response($clientException->getResponse());
        }
    }

    /**
     * The string representing a JSON response that should be decoded to an
     * associative array
     *
     * @param string $json
     *
     * @return mixed
     * @throws \Exception
     */
    protected function decodeJson($json)
    {
        return \GuzzleHttp\json_decode($json, true);
    }

    /**
     * Prepares the authentication array that has to be passed on each request
     *
     * @return array
     */
    protected function buildBasicRequestOptions(): array
    {
        return [
            'auth' => [
                $this->user,
                $this->password
            ],
            'headers' => [
                'X-Atlassian-Token' => 'nocheck'
            ]
        ];
    }

    /**
     * This method encapsulates the logic of preparing the request for being sent
     * via Guzzle HTTP
     *
     * @param Request $request
     *
     * @return array
     */
    protected function buildRequestOptionsForRequest(Request $request)
    {
        $opts = [];

        if ($request->getMethod() === Request::METHOD_POST) {
            if ($request->getPayload()) {
                $opts = [
                    'body' => \GuzzleHttp\json_encode($request->getPayload()),
                    'headers' => ['Content-Type' => 'application/json']
                ];
            }
        }

        return $opts;
    }

    public function buildUrlForRequest(Request $request): string
    {
        $ret = $request->getUrl();

        if ($request->getMethod() === Request::METHOD_GET) {
            if ($request->getPayload()) {
                $ret .= '?' . $this->arrayToQueryString($request->getPayload());
            }
        }

        return $ret;
    }

    /**
     * @param array $inputParams
     *
     * @return string The query string representation of the params
     */
    protected function arrayToQueryString(array $inputParams): string
    {
        $params = [];

        foreach ($inputParams as $name => $value) {
            if (is_string($value) && empty($value)) {
                continue;
            }

            $params[] = "$name=$value";
        }

        return implode("&", $params);
    }
}

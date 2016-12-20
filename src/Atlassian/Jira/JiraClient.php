<?php

namespace Atlassian\Jira;

use Atlassian\ApiClient;
use Atlassian\Stash\Api\ResultPage;
use Atlassian\Stash\Api\Request;

/**
 * @link https://docs.atlassian.com/jira/REST/server/
 */
class JiraClient extends ApiClient
{
    protected $cache = [];

    /**
     * @param string $issueKey The issue KEY to download information
     *
     * @return array
     */
    public function getTicketInformation(string $issueKey): array
    {
        if (array_key_exists($issueKey, $this->cache)) {
            return $this->cache[$issueKey];
        }

        $uri = sprintf(
            'rest/api/2/issue/%s',
            $issueKey
        );

        $request = new Request(
            Request::METHOD_GET,
            $uri
        );

        $page = $this->sendRequest($request);

        $payload = $page->getPayload();

        if (!$payload) {
            $payload = [];
        }

        return $this->cache[$issueKey] = $payload;
    }
}

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
    /**
     * @param string $issueKey The issue KEY to download information
     *
     * @return ResultPage
     */
    public function getTicketInformation(string $issueKey): ResultPage
    {
        $uri = sprintf(
            'rest/api/2/issue/%s',
            $issueKey
        );

        $request = new Request(
            Request::METHOD_GET,
            $uri
        );

        $page = $this->sendRequest($request);

        return $page->getPayload();
    }
}
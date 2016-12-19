<?php

namespace Atlassian\Stash;

use Atlassian\ApiClient;
use Atlassian\Stash\Api\Branch;
use Atlassian\Stash\Api\Mapper\BranchMapper;
use Atlassian\Stash\Api\Mapper\ProjectMapper;
use Atlassian\Stash\Api\Mapper\PullRequestMapper;
use Atlassian\Stash\Api\Mapper\RepoMapper;
use Atlassian\Stash\Api\Project;
use Atlassian\Stash\Api\PullRequest;
use Atlassian\Stash\Api\Repo;

use Atlassian\Stash\Api\Request;

/**
 * The BitBucket Server (Stash) Client
 *
 * @see https://developer.atlassian.com/stash/docs/latest/reference/rest-api.html
 */
class StashClient extends ApiClient
{
    protected $basicUri = 'rest/api/1.0';

    /**
     * @return array|Project[] The list of available projects
     */
    public function getProjects(): array
    {
        $request = new Request(
            Request::METHOD_GET,
            $this->buildUri('projects')
        );

        $response = $this->sendRequest($request);

        return (new ProjectMapper())->allFromPhpData($response->getPayload()['values']);
    }

    // @ToDo - Make a test...
    public function createProject(string $key, string $name, string $description = '', string $avatarBase64 = '')
    {
        $opts    = [
            'key'  => $key,
            'name' => $name,
        ];

        if ($description) {
            $opts['description'] = $description;
        }

        if ($avatarBase64) {
            $opts['avatar'] = $avatarBase64;
        }

        $request = new Request(
            Request::METHOD_POST,
            $this->buildUri('projects'),
            $opts
        );

        $response = $this->sendRequest($request);

        return (new ProjectMapper())->fromPhpData($response->getPayload());
    }

    public function createRepository(string $projectKey, array $params)
    {
        $request = new Request(
            Request::METHOD_POST,
            $this->buildUri(sprintf('projects/%s/repos', $projectKey)),
            $params
        );

        $response = $this->sendRequest($request);

        return (new RepoMapper())->fromPhpData($response->getPayload());
    }

    public function deleteRepository(string $projectKey, string $repoSlug)
    {
        $request = new Request(
            Request::METHOD_DELETE,
            $this->buildUri(sprintf('projects/%s/repos/%s', $projectKey, $repoSlug))
        );

         return $this->sendRequest($request)->getStatusCode() === 204;
    }

    /**
     * @param string $projectKey
     *
     * @return array|Repo[]
     */
    public function getProjectRepositories(string $projectKey): array
    {
        $uri = sprintf($this->buildUri('projects/%s/repos'), $projectKey);

        $request = new Request(
            Request::METHOD_GET,
            $uri
        );

        $response = $this->sendRequest($request);

        return (new RepoMapper())->allFromPhpData($response->getPayload()['values']);
    }

    /**
     * @param string $projectKey
     * @param string    $repoSlug
     *
     * @return Branch[]
     */
    public function getProjectRepositoryBranches(string $projectKey, string $repoSlug)
    {
        $uri = sprintf(
            $this->buildUri('projects/%s/repos/%s/branches'),
            $projectKey,
            $repoSlug
        );

        $request = new Request(
            Request::METHOD_GET,
            $uri
        );

        $response = $this->sendRequest($request);

        return (new BranchMapper())->allFromPhpData($response->getPayload()['values']);
    }

    /**
     * @param string $projectKey
     * @param string $repoSlug
     * @param array  $options The options to pass for the request
     *
     * @return PullRequest[] The list of found pull requests
     */
    public function getProjectRepositoryPullRequests(
        string $projectKey,
        string $repoSlug,
        array $options = []
    ) {
        $uri = sprintf(
            $this->buildUri('projects/%s/repos/%s/pull-requests'),
            $projectKey,
            $repoSlug
        );

        $request = new Request(
            Request::METHOD_GET,
            $uri,
            $options
        );

        $response = $this->sendRequest($request);

        return (new PullRequestMapper())->allFromPhpData($response->getPayload()['values']);
    }

    public function getProjectRepositoryCompareCommits(
        string $projectKey,
        string $repoSlug,
        string $fromRef = null,
        string $toRef = null,
        string $fromRepo = null
    ) {
        $uri = sprintf(
            $this->buildUri('projects/%s/repos/%s/compare/commits'),
            $projectKey,
            $repoSlug
        );

        $request = new Request(
            Request::METHOD_GET,
            $uri,
            [
                'from'     => $fromRef,
                'to'       => $toRef,
                'fromRepo' => $fromRepo,
                'limit'    => 1000,
            ]
        );

        $page = $this->sendRequest($request);

        return $page;
    }

    /**
     * @param string $rest
     *
     * @return string
     */
    protected function buildUri(string $rest): string
    {
        return "$this->basicUri/$rest";
    }
}

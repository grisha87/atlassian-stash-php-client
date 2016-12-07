<?php

namespace Atlassian\Stash\Api\Mapper;

use Atlassian\Stash\Api\PullRequest;

class PullRequestMapper extends MapperAbstract
{
    public function fromPhpData(array $data)
    {
        return new PullRequest($data);
    }
}
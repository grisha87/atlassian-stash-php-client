<?php

namespace Atlassian\Stash\Api\Mapper;

use Atlassian\Stash\Api\Repo;

class RepoMapper extends MapperAbstract
{
    public function fromPhpData(array $data)
    {
        return new Repo($data);
    }
}

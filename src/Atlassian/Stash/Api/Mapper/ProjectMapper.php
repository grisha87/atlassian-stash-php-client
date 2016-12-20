<?php

namespace Atlassian\Stash\Api\Mapper;

use Atlassian\Stash\Api\Entity\Project;

class ProjectMapper extends MapperAbstract
{
    public function fromPhpData(array $data)
    {
        return new Project($data);
    }
}

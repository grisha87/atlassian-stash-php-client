<?php

namespace Atlassian\Stash\Api\Mapper;

use Atlassian\Stash\Api\Entity\Branch;

class BranchMapper extends MapperAbstract
{
    public function fromPhpData(array $data)
    {
        return new Branch($data);
    }
}

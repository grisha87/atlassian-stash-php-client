<?php

namespace Atlassian\Stash\Api\Mapper;

use Atlassian\Stash\Api\Branch;

class BranchMapper extends MapperAbstract
{
    public function fromPhpData(array $data)
    {
        return new Branch($data);
    }
}

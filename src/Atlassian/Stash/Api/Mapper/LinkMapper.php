<?php

namespace Atlassian\Stash\Api\Mapper;

use Atlassian\Stash\Api\Entity\Link;

class LinkMapper extends MapperAbstract
{
    public function fromPhpData(array $data)
    {
        return new Link($data['href'] ?? '');
    }
}

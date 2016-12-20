<?php

namespace Atlassian\Stash\Api\Mapper;

use Atlassian\Stash\Api\Entity\Project;

class ProjectMapper extends MapperAbstract
{
    public function fromPhpData(array $data)
    {
        $proj = new Project();

        $proj->setId($data['id'] ?? null);
        $proj->setKey($data['key'] ?? '');
        $proj->setName($data['name'] ?? '');
        $proj->setDescription($data['description'] ?? '');
        $proj->setIsPublic($data['public'] ?? false);
        $proj->setType($data['type'] ?? '');

        $linkMapper = new LinkMapper();
        $links = [];

        foreach ($data['links'] as $rel => $details) {
            $links[$rel] = $linkMapper->allFromPhpData($details);
        }

        $proj->setLinks($links);

        return $proj;
    }
}

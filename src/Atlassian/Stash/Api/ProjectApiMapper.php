<?php

namespace Atlassian\Stash\Api;

class ProjectApiMapper
{
    public function getFromEncoded(array $params)
    {
        return (new Project())
            ->setKey($params['key'])
            ->setName(isset($params['name']) ? $params['name'] : '')//optional
            ->setDescription(isset($params['description']) ? $params['description'] : ''); //optional
    }

    public function getAllFromEncoded(array $encs)
    {
        $data = [];
        foreach ($encs as $enc) {
            $data[] = $this->getFromEncoded($enc);
        }

        return $data;
    }
}
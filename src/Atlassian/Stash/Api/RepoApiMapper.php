<?php

namespace Atlassian\Stash\Api;

class RepoApiMapper
{
    public function getFromEncoded(array $params)
    {
        return (new Repo())
            ->setName($params['name'])
            ->setCloneUrl($params['cloneUrl'])
            ->setProjectKey($params['project']['key']);
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

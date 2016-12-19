<?php

namespace Atlassian\Stash\Api\Mapper;

abstract class MapperAbstract
{
    public function allFromPhpData(array $data)
    {
        $ret = [];

        foreach ($data as $datum) {
            $ret[] = $this->fromPhpData($datum);
        }

        return $ret;
    }

    abstract public function fromPhpData(array $data);
}

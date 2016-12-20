<?php

namespace Atlassian\Stash\Api\Mapper;

/**
 * The role of an mapper is to translate the raw API response
 * to the entity.
 */
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

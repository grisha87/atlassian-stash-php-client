<?php

namespace Atlassian\Stash\Api\Mapper;

use Atlassian\Stash\Api\Entity\ResultPage;

class ResultPageMapper
{
    /**
     * @param array $data
     *
     * @return ResultPage
     */
    public function mapFromPhpArray(array $data)
    {
        $inst = new ResultPage($data);

        $inst->setSize($data['size']);
        $inst->setStart($data['start']);
        $inst->setLimit($data['limit']);
        $inst->setIsLastPage($data['isLastPage']);
        $inst->setValues($data['values']);

        if (array_key_exists('filter', $data)) {
            $inst->setFilter($data['filter']);
        }

        if (array_key_exists('nextPageStart', $data)) {
            $inst->setNextPageStart($data['nextPageStart']);
        }

        return $inst;
    }
}

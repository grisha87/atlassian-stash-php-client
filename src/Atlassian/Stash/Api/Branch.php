<?php

namespace Atlassian\Stash\Api;

/**
 * Represents a single branch information from the repository
 */
class Branch extends EntityAbstract
{
    protected $id;

    protected $displayId;

    protected $type;

    protected $latestCommit;

    protected $latestChangeset;

    protected $default;

    /** @inheritdoc */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->mapDataKeysToProperties([
            'id',
            'displayId',
            'type',
            'latestCommit',
            'latestChangeset',
            'isDefault'
        ]);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @mixed string
     */
    public function getDisplayId()
    {
        return $this->displayId;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getLatestCommit()
    {
        return $this->latestCommit;
    }

    /**
     * @return string
     */
    public function getLatestChangeset()
    {
        return $this->latestChangeset;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }
}

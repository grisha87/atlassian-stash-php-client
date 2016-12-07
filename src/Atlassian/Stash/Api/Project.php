<?php

namespace Atlassian\Stash\Api;

/**
 * API Project representation
 */
class Project extends EntityAbstract
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $key;

    /** @var string */
    protected $name;

    /** @var string|null */
    protected $description;

    /** @var bool */
    protected $public;

    /** @var string */
    protected $type;

    /** @inheritdoc */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->mapDataKeysToProperties([
            'id',
            'key',
            'name',
            'description',
            'public',
            'type',
        ]);

        $this->buildLinks();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
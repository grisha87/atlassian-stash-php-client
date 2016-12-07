<?php

namespace Atlassian\Stash\Api;

/**
 * Stash API repository representation
 */
class Repo extends EntityAbstract
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $scmId;

    /** @var string */
    protected $state;

    /** @var string */
    protected $statusMessage;

    /** @var bool */
    protected $forkable;

    /** @var Project */
    protected $project;

    /** @var bool */
    protected $public;

    /** @var string */
    protected $slug;

    /** @inheritdoc */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->mapDataKeysToProperties([
            'id',
            'slug',
            'name',
            'scmId',
            'state',
            'statusMessage',
            'forkable',
            'public',
        ]);

        $this->buildProject();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getScmId()
    {
        return $this->scmId;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    /**
     * @return boolean
     */
    public function isForkable()
    {
        return $this->forkable;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @return boolean
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    protected function buildProject()
    {
        $project = $this->extractValue('project');

        $this->project = new Project($project);
    }
}
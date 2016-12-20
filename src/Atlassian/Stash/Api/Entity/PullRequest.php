<?php

namespace Atlassian\Stash\Api\Entity;

class PullRequest extends EntityAbstract
{
    const DIRECTION_INCOMING = 'incoming';

    /** @var int */
    protected $id;

    /** @var int */
    protected $version;

    /** @var string */
    protected $title;

    /** @var string */
    protected $description;

    /** @var string */
    protected $state;

    /** @var bool */
    protected $open;

    /** @var bool */
    protected $closed;

    protected $createdDate;

    protected $updatedDate;

    protected $fromRef;

    protected $toRef;

    /** @var bool */
    protected $locked;

    /** @var User[] */
    protected $author;

    /** @var User[] */
    protected $reviewers;

    /** @var User[] */
    protected $participants;

    protected $properties;

    /** @inheritdoc */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->mapDataKeysToProperties([
            'id',
            'version',
            'title',
            'description',
            'state',
            'open',
            'closed',
            'createdDate',
            'updatedDate',
            'fromRef',
            'toRef',
            'author',
            'reviewers',
            'participants',
            'properties',
        ]);
    }

    /**
     * @return mixed
     */
    public function getFromRef()
    {
        return $this->fromRef;
    }

    /**
     * @return mixed
     */
    public function getToRef()
    {
        return $this->toRef;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}

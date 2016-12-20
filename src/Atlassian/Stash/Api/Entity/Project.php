<?php

namespace Atlassian\Stash\Api\Entity;

/**
 * API Project representation
 */
class Project
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $key = '';

    /** @var string */
    protected $name = '';

    /** @var string */
    protected $description = '';

    /** @var bool */
    protected $public;

    /** @var string */
    protected $type = '';

    /** @var Link[] */
    protected $links = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->public;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function setKey(string $key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param bool $public
     *
     * @return $this
     */
    public function setIsPublic(bool $public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param array $links
     *
     * @return $this
     */
    public function setLinks(array $links)
    {
        $this->links = $links;

        return $this;
    }
}

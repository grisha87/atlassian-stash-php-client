<?php

namespace Atlassian\Stash\Api\Entity;

/**
 * Represents a Link as modelled in the Stash API
 */
class Link
{
    /** @var string */
    protected $href;

    /** @var string */
    protected $rel;

    /**
     * @param string $rel
     * @param string $href
     */
    public function __construct($rel, $href)
    {
        $this->rel  = $rel;
        $this->href = $href;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @return string
     */
    public function getRel(): string
    {
        return $this->rel;
    }
}

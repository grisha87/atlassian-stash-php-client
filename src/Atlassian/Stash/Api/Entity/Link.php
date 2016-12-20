<?php

namespace Atlassian\Stash\Api\Entity;

/**
 * Represents a Link as modelled in the Stash API
 */
class Link
{
    /** @var string */
    protected $href;

    /**
     * @param string $href
     */
    public function __construct(string $href)
    {
        $this->href = $href;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }
}

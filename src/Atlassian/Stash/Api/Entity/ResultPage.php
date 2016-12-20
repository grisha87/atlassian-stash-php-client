<?php

namespace Atlassian\Stash\Api\Entity;

/**
 * Representation of a single paged API response
 */
class ResultPage
{
    /** @var int Number of elements on the page */
    protected $size;

    /** @var int The position from which the page starts */
    protected $start;

    /** @var string The filter criteria used to build the page */
    protected $filter;

    /** @var int The limit set on the page */
    protected $limit;

    /** @var bool Marks if the current page is the last one */
    protected $isLastPage;

    /** @var int Shows the starting position for the next page */
    protected $nextPageStart;

    /** @var array The actual page contents */
    protected $values;

    /**
     * @param array $data The data (may be the one returned from the request)
     */
    public function __construct(array $data = [])
    {
        $this->size          = $data['size'] ?? null;
        $this->limit         = $data['limit'] ?? null;
        $this->start         = $data['start'] ?? null;
        $this->nextPageStart = $data['nextPageStart'] ?? null;
        $this->values        = $data['values'] ?? null;
        $this->filter        = $data['filter'] ?? null;
        $this->isLastPage    = $data['isLastPage'] ?? null;
    }

    /**
     * @param bool $isLastPage
     *
     * @return $this
     */
    public function setIsLastPage($isLastPage)
    {
        $this->isLastPage = $isLastPage;

        return $this;
    }

    /**
     * Returns the size of the page
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     *
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Returns the limit value used to get the data
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     *
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Checks if this page is the last page with data
     *
     * @return bool
     */
    public function isLastPage()
    {
        return $this->isLastPage;
    }

    /**
     * Tells where is the starting point for the data from this page
     *
     * @return int
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param int $start
     *
     * @return $this
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Returns the filter used to obtain this page
     *
     * @return string
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param string $filter
     *
     * @return $this
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Points out from which position the next page will start
     *
     * @return int
     */
    public function getNextPageStart()
    {
        return $this->nextPageStart;
    }

    /**
     * @param int $nextPageStart
     *
     * @return $this
     */
    public function setNextPageStart($nextPageStart)
    {
        $this->nextPageStart = $nextPageStart;

        return $this;
    }

    /**
     * Returns the values present on the page
     *
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param array $values
     *
     * @return $this
     */
    public function setValues($values)
    {
        $this->values = $values;

        return $this;
    }
}

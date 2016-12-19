<?php

namespace Atlassian\Stash\Api;

/**
 * Abstract entity class serving as a base for other entities
 * that may be returned by the API.
 *
 * Basically this class serves as a data container
 */
abstract class EntityAbstract
{
    /** @var array */
    protected $links = [];

    /**
     * The internal data array
     *
     * Here we should hold decoded API entities
     *
     * @var array
     */
    private $rawData;

    /**
     * New instance of the entity
     *
     * If the first argument is provided, the internal data array
     * of the entity is set to this value
     *
     * @param array $data The project data to set
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->setRawData($data);
        }
    }

    /**
     * Sets the data for this entity
     *
     * @param array $rawData
     */
    public function setRawData(array $rawData)
    {
        $this->rawData = $rawData;
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return bool
     */
    public function hasLinks()
    {
        return empty($this->links);
    }

    /**
     * @param string $key The data key to check
     *
     * @return mixed Returns the value from the data array for the key, or NULL if not found
     */
    protected function extractValue($key)
    {
        if (isset($this->rawData[$key])) {
            return $this->rawData[$key];
        }

        return null;
    }

    /**
     * @param string[] $fields The data field names to map onto properties
     */
    protected function mapDataKeysToProperties($fields)
    {
        foreach ($fields as $field) {
            $this->{$field} = $this->extractValue($field);
        }
    }

    /**
     * Go through the raw data and re-assemble link information
     */
    protected function buildLinks()
    {
        $definitions = $this->extractValue('links');

        if ($definitions) {
            foreach ($definitions as $rel => $links) {
                foreach ($links as $link) {
                    $this->links[] = new Link($rel, $link['href']);
                }
            }
        }
    }

    public function getRawData()
    {
        return $this->rawData;
    }
}

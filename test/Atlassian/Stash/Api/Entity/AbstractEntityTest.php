<?php

namespace Atlassian\Stash\Api\Entity;

use PHPUnit\Framework\TestCase;

abstract class AbstractEntityTest extends TestCase
{
    /**
     * The example API response loaded from the JSON file via the loadExampleApiResponse()
     * method. Entity test cases are designed to use those example responses
     * to check their compliance and ability to handle the data provided within.
     *
     * @var array
     */
    protected $exampleResponse = [];

    /**
     * Loads the example response from selected JSON file placed in the test
     * directory.
     *
     * @todo We could consider adding API version to the parameter and path for future applications
     *
     * @param string $string The example file name
     *
     * @return array
     */
    protected function loadExampleApiResponse(string $string): array
    {
        $contents = file_get_contents(__DIR__ . '/../ExampleResponses/' . $string . '.json');

        return \GuzzleHttp\json_decode($contents, true);
    }
}
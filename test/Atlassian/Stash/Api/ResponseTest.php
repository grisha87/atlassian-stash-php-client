<?php

namespace Atlassian\Stash\Api;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

class ResponseTest extends TestCase
{
    /** @var Response */
    protected $response;

    public function setUp()
    {
        parent::setUp();

        $guzzle = new GuzzleResponse(
            200,
            [],
            '{ "some": "value" }'
        );

        $this->response = new Response($guzzle);
    }

    public function testConstructorSetsPayloadCorrectly()
    {
        $expected = ['some' => 'value'];

        $this->assertEquals($expected, $this->response->getPayload());
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    public function testPagedResponseIsDiscovered()
    {
        $guzzle = $this->loadExampleResponse('PageExample');

        $response = new Response($guzzle);

        $this->assertTrue($response->isPaged());
        $this->assertFalse($response->isMessage());
        $this->assertFalse($response->isError());
    }

    public function testErrorResponseIsDiscovered()
    {
        $guzzle = $this->loadExampleResponse('ErrorsExample');

        $response = new Response($guzzle);

        $this->assertFalse($response->isPaged());
        $this->assertFalse($response->isMessage());
        $this->assertTrue($response->isError());
    }

    public function testMessageResponseIsDiscovered()
    {
        $guzzle = $this->loadExampleResponse('MessageExample');

        $response = new Response($guzzle);

        $this->assertFalse($response->isPaged());
        $this->assertTrue($response->isMessage());
        $this->assertFalse($response->isError());
    }

    /**
     * Helper method providing test case data from JSON files which
     * are examples taken from the API docs
     *
     * @param string $name the example file name to load
     *
     * @return GuzzleResponse
     */
    protected function loadExampleResponse(string $name): GuzzleResponse
    {
        $payload = file_get_contents(__DIR__ . '/ExampleResponses/' . $name . '.json');

        return new GuzzleResponse(200, [], $payload);
    }

    public function testExtractedPayloadIsEmptyArrayWhenNoDataInGuzzleResponse()
    {
        $guzzle   = new GuzzleResponse();
        $response = new Response($guzzle);

        $this->assertEquals([], $response->getPayload());
    }
}
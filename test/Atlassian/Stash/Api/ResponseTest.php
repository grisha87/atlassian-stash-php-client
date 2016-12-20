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

        $this->assertEquals($expected, $this->response->getDecodedContents());
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    public function testPagedResponseIsDiscovered()
    {
        $response = $this->loadExampleResponse('PageExample');

        $this->assertTrue($response->isPaged());
        $this->assertFalse($response->isMessage());
        $this->assertFalse($response->isError());
    }

    public function testPagedResponseIsLoadedCorrectly()
    {
        $response = $this->loadExampleResponse('PageExample');

        $data  = $response->getDecodedContents();

        $this->assertEquals(3, $data['size']);
        $this->assertEquals(3, $data['limit']);
        $this->assertEquals(0, $data['start']);
        $this->assertEquals(3, $data['nextPageStart']);
        $this->assertEquals(null, $data['filter']);

        $values = $data['values'];

        $this->assertNotEmpty($values);
        $this->assertCount(3, $values);
    }

    public function testErrorResponseIsDiscovered()
    {
        $response = $this->loadExampleResponse('ErrorsExample');

        $this->assertFalse($response->isPaged());
        $this->assertFalse($response->isMessage());
        $this->assertTrue($response->isError());
    }

    public function testErrorResponseIsLoadedCorrectly()
    {
        $response = $this->loadExampleResponse('ErrorsExample');

        $errors = $response->getDecodedContents()['errors'];

        $this->assertNotEmpty($errors);
        $this->assertCount(2, $errors);

        $this->assertEquals('field_a', $errors[0]['context']);
        $this->assertEquals('A detailed validation error message for field_a.', $errors[0]['message']);
        $this->assertEquals(null, $errors[0]['exceptionName']);

        $this->assertEquals(null, $errors[1]['context']);
        $this->assertEquals("A detailed error message.", $errors[1]['message']);
        $this->assertEquals(null, $errors[1]['exceptionName']);
    }

    public function testMessageResponseIsDiscovered()
    {
        $response = $this->loadExampleResponse('MessageExample');

        $this->assertFalse($response->isPaged());
        $this->assertTrue($response->isMessage());
        $this->assertFalse($response->isError());
    }

    public function testMessageResponseIsLoadedCorrectly()
    {
        $response = $this->loadExampleResponse('MessageExample');

        $payload = $response->getDecodedContents();

        $this->assertNull($payload['context']);
        $this->assertEquals("Repository scheduled for deletion.", $payload['message']);
        $this->assertNull($payload['exceptionName']);
    }

    /**
     * Helper method providing test case data from JSON files which
     * are examples taken from the API docs
     *
     * @param string $name the example file name to load
     *
     * @return Response
     */
    protected function loadExampleResponse(string $name): Response
    {
        $payload = file_get_contents(__DIR__ . '/ExampleResponses/' . $name . '.json');

        return new Response (new GuzzleResponse(200, [], $payload));
    }

    public function testExtractedPayloadIsEmptyArrayWhenNoDataInGuzzleResponse()
    {
        $guzzle   = new GuzzleResponse();
        $response = new Response($guzzle);

        $this->assertEquals([], $response->getDecodedContents());
    }
}
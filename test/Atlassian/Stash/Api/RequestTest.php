<?php

namespace Atlassian\Stash\Api;

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /** @var Request */
    protected $request;

    protected $testData = [
        'method' => 'GET',
        'url'    => 'foo',
        'params' => [
            'start'  => 0,
            'limit'  => 1000,
        ]
    ];

    public function setUp()
    {
        $this->request = new Request(
            $this->testData['method'],
            $this->testData['url'],
            $this->testData['params']
        );
    }

    public function testTheUrlIsSetCorrectly()
    {
        $this->assertEquals($this->testData['url'], $this->request->getUrl());
    }

    public function testTheMethodIsSetCorrectly()
    {
        $this->assertEquals($this->testData['method'], $this->request->getMethod());
    }

    public function testTheParamsAreSetCorrectly()
    {
        $this->assertEquals($this->testData['params'], $this->request->getPayload());
    }

    public function testTheLimitIsSetCorrectly()
    {
        $this->assertEquals($this->testData['params']['limit'], $this->request->getParam('limit'));
    }

    public function testTheStartIsSetCorrectly()
    {
        $this->assertEquals($this->testData['params']['start'], $this->request->getParam('start'));
    }

    public function testToStringReturnsUrlWithQuery()
    {
        $expect = 'foo?start=0&limit=1000';

        $this->assertEquals($expect, (string) $this->request);
    }

    public function testToStringReturnsUrlWithoutParamsWhenThoseAreEmpty()
    {
        $url = 'foo';

        $req = new Request(Request::METHOD_GET, $url);

        $this->assertEquals($url, (string) $req);
    }

    public function testToStringHandlesStartOnly()
    {
        $url   = "foo";
        $start = 10;

        $req = new Request(Request::METHOD_GET, $url, ['start' => $start]);

        $this->assertEquals("foo?start=10", (string) $req);
    }

    public function testToStringHandlesLimitOnly()
    {
        $url   = "foo";
        $limit = 10;

        $req = new Request(Request::METHOD_GET, $url, ['limit' => $limit]);

        $this->assertEquals("$url?limit=10", (string) $req);
    }

    public function testToStringSkipsParamsThatAreEmpty()
    {
        $params = [
            'a' => '',
            'b' => 1,
        ];

        $url = 'foo';

        $req = new Request(Request::METHOD_GET, $url, $params);

        $this->assertEquals('foo?b=1', (string) $req);
    }
}
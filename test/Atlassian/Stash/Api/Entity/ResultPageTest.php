<?php

namespace Atlassian\Stash\Api\Entity;

use PHPUnit\Framework\TestCase;

class ResultPageTest extends TestCase
{
    protected $testData = [
        'size'          => 3,
        'limit'         => 3,
        'isLastPage'    => false,
        'values'        => [
            'a',
            'b',
            'c'
        ],
        'start'         => 0,
        'filter'        => null,
        'nextPageStart' => 3,
    ];

    /** @var ResultPage */
    protected $testPage;

    public function setUp()
    {
        parent::setUp();

        $this->testData = $this->loadExampleResponse('PageExample');

        $this->testPage = new ResultPage($this->testData);
    }

    public function testIAmAbleToGetSizeOfThePage()
    {
        $this->assertEquals($this->testData['size'], $this->testPage->getSize());
    }

    public function testIAmAbleToSetTheSizeOfThePage()
    {
        $val = 10;
        $this->testPage->setSize($val);
        $this->assertEquals($val, $this->testPage->getSize());
    }

    public function testIAmAbleToGetPageLimit()
    {
        $this->assertEquals($this->testData['limit'], $this->testPage->getLimit());
    }

    public function testIAmAbleToSetTheLimit()
    {
        $val = 10;
        $this->testPage->setLimit($val);
        $this->assertEquals($val, $this->testPage->getLimit());
    }

    public function testIAmAbleToCheckIfThisIsTheLastPage()
    {
        $this->assertEquals($this->testData['isLastPage'], $this->testPage->isLastPage());
    }

    public function testIAmAbleToSetLastPageMarker()
    {
        $val = !$this->testPage->isLastPage();
        $this->testPage->setIsLastPage($val);
        $this->assertEquals($val, $this->testPage->isLastPage());
    }

    public function testIAmAbleToGetTheStartPoint()
    {
        $this->assertEquals($this->testData['start'], $this->testPage->getStart());
    }

    public function testIAmAbleToSetTheStartPoint()
    {
        $val = 10;
        $this->testPage->setStart($val);
        $this->assertEquals($val, $this->testPage->getStart());
    }

    public function testIAmAbleToGetTheFilter()
    {
        $this->assertEquals($this->testData['filter'], $this->testPage->getFilter());
    }

    public function testIAmAbleToSetTheFilter()
    {
        $val = "foo";
        $this->testPage->setFilter($val);
        $this->assertEquals($val, $this->testPage->getFilter());
    }

    public function testIAmAbleToCheckWhereNextPageStarts()
    {
        $this->assertEquals($this->testData['nextPageStart'], $this->testPage->getNextPageStart());
    }

    public function testIAmAbleToSetTheNextPageStart()
    {
        $val = 10;
        $this->testPage->setNextPageStart($val);
        $this->assertEquals($val, $this->testPage->getNextPageStart());
    }

    public function testIAmAbleToGetTheValues()
    {
        $val = $this->testData['values'];

        $this->assertEquals($val, $this->testPage->getValues());
        $this->assertNotEmpty($val);
    }

    public function testIAmAbleToSetTheValuesManually()
    {
        $val = [1, 2, 3];
        $this->testPage->setValues($val);
        $this->assertEquals($val, $this->testPage->getValues());
    }

    protected function loadExampleResponse(string $string): array
    {
        $contents = file_get_contents(__DIR__ . '/../ExampleResponses/' . $string . '.json');

        return \GuzzleHttp\json_decode($contents, true);
    }
}
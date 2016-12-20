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

        $this->testPage = new ResultPage($this->testData);
    }

    public function testIAmAbleToGetSizeOfThePage()
    {
        $this->assertEquals($this->testData['size'], $this->testPage->getSize());
    }

    public function testIAmAbleToGetPageLimit()
    {
        $this->assertEquals($this->testData['limit'], $this->testPage->getLimit());
    }

    public function testIAmAbleToCheckIfThisIsTheLastPage()
    {
        $this->assertEquals($this->testData['isLastPage'], $this->testPage->isLastPage());
    }

    public function testIAmAbleToGetTheStartPoint()
    {
        $this->assertEquals($this->testData['start'], $this->testPage->getStart());
    }

    public function testIAmAbleToGetTheFilter()
    {
        $this->assertEquals($this->testData['filter'], $this->testPage->getFilter());
    }

    public function testIAmAbleToCheckWhereNextPageStarts()
    {
        $this->assertEquals($this->testData['nextPageStart'], $this->testPage->getNextPageStart());
    }

    public function testIAmAbleToGetTheValues()
    {
        $val = $this->testData['values'];

        $this->assertEquals($val, $this->testPage->getValues());
        $this->assertNotEmpty($val);
    }
}
<?php

namespace Atlassian\Stash\Api\Entity;

class ResultPageTest extends AbstractEntityTest
{
    /** @var ResultPage */
    protected $testPage;

    public function setUp()
    {
        parent::setUp();

        $this->exampleResponse = $this->loadExampleResponse('PageExample');

        $this->testPage = new ResultPage($this->exampleResponse);
    }

    public function testAllTheParamsMakeSenseAfterConstruct()
    {
        $this->assertNotNull($this->testPage->getSize());
        $this->assertNotNull($this->testPage->getStart());
        $this->assertNotNull($this->testPage->getLimit());
        $this->assertNotNull($this->testPage->getFilter());
        $this->assertNotNull($this->testPage->isLastPage());
        $this->assertNotNull($this->testPage->getValues());
        $this->assertNotNull($this->testPage->getNextPageStart());
    }

    public function testIAmAbleToGetSizeOfThePage()
    {
        $this->assertEquals($this->exampleResponse['size'], $this->testPage->getSize());
    }

    public function testIAmAbleToSetTheSizeOfThePage()
    {
        $val = 10;
        $this->testPage->setSize($val);
        $this->assertEquals($val, $this->testPage->getSize());
    }

    public function testIAmAbleToGetPageLimit()
    {
        $this->assertEquals($this->exampleResponse['limit'], $this->testPage->getLimit());
    }

    public function testIAmAbleToSetTheLimit()
    {
        $val = 10;
        $this->testPage->setLimit($val);
        $this->assertEquals($val, $this->testPage->getLimit());
    }

    public function testIAmAbleToCheckIfThisIsTheLastPage()
    {
        $this->assertEquals($this->exampleResponse['isLastPage'], $this->testPage->isLastPage());
    }

    public function testIAmAbleToSetLastPageMarker()
    {
        $val = !$this->testPage->isLastPage();
        $this->testPage->setIsLastPage($val);
        $this->assertEquals($val, $this->testPage->isLastPage());
    }

    public function testIAmAbleToGetTheStartPoint()
    {
        $this->assertEquals($this->exampleResponse['start'], $this->testPage->getStart());
    }

    public function testIAmAbleToSetTheStartPoint()
    {
        $val = 10;
        $this->testPage->setStart($val);
        $this->assertEquals($val, $this->testPage->getStart());
    }

    public function testIAmAbleToGetTheFilter()
    {
        $this->assertEquals($this->exampleResponse['filter'], $this->testPage->getFilter());
    }

    public function testIAmAbleToSetTheFilter()
    {
        $val = "foo";
        $this->testPage->setFilter($val);
        $this->assertEquals($val, $this->testPage->getFilter());
    }

    public function testIAmAbleToCheckWhereNextPageStarts()
    {
        $this->assertEquals($this->exampleResponse['nextPageStart'], $this->testPage->getNextPageStart());
    }

    public function testIAmAbleToSetTheNextPageStart()
    {
        $val = 10;
        $this->testPage->setNextPageStart($val);
        $this->assertEquals($val, $this->testPage->getNextPageStart());
    }

    public function testIAmAbleToGetTheValues()
    {
        $val = $this->exampleResponse['values'];

        $this->assertEquals($val, $this->testPage->getValues());
        $this->assertNotEmpty($val);
    }

    public function testIAmAbleToSetTheValuesManually()
    {
        $val = [1, 2, 3];
        $this->testPage->setValues($val);
        $this->assertEquals($val, $this->testPage->getValues());
    }
}
<?php

namespace App\Tests\Prosperworks;

use App\Prosperworks\Requester;
use App\Prosperworks\ResourceUtility\DataLister;
use PHPUnit\Framework\TestCase;

class DataListerTest extends TestCase
{
    /**
     * @var DataLister
     */
    protected $fixture = null;

    /**
     * @var Requester
     */
    private $requester = null;

    protected function setUp()
    {
        parent::setup();

        $this->requester = $this->createMock(Requester::class);

        $this->fixture = new DataLister($this->requester);
    }

    public function testRequesterCalledWithType()
    {
        $type = rand();
        $uri  = $type.'/search';

        $this->requester->expects($this->once())
            ->method('getResponse')
            ->with($uri)
            ->willReturn('foo');

        $this->fixture->getResourceDataList($type);
    }

    public function testRequesterCalledWithResultsRequirements()
    {
        $postFields = "{\n  \"page_size\": 25,\n  \"sort_by\": \"name\"\n  \n}";

        $this->requester->expects($this->once())
            ->method('getResponse')
            ->with($this->anything(), $postFields)
            ->willReturn('foo');

        $this->fixture->getResourceDataList(rand());
    }

    public function testReturnResponse()
    {
        $expected = (string) rand();

        $this->requester->method('getResponse')
            ->willReturn($expected);

        $actual = $this->fixture->getResourceDataList(rand());

        $this->assertSame($actual, $expected);
    }
}

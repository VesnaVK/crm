<?php

namespace App\Tests\Prosperworks;

use App\Prosperworks\Requester;
use App\Prosperworks\ResourceUtility\RelatedResourceMaker;
use PHPUnit\Framework\TestCase;

class RelatedResourceMakerTest extends TestCase
{
    /**
     * @var RelatedResourceMaker
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

        $this->fixture = new RelatedResourceMaker($this->requester);
    }

    public function testRequesterCalledWithType()
    {
        $type = rand();

        $this->requester->expects($this->once())
            ->method('getResponse')
            ->with($type);

        $this->fixture->makeRelated($type, rand(), rand(), rand(), rand());
    }

    public function testRequesterCalledWithPostFields()
    {
        $name         = rand();
        $relationship = rand();
        $id           = rand();

        $postfields = "{\n\t\"name\":\"{$name}\",\n\t\"{$relationship}\":\"{$id}\"\n}";

        $this->requester->expects($this->once())
            ->method('getResponse')
            ->with($this->anything(), $postfields);

        $this->fixture->makeRelated(rand(), $name, $relationship, $id);
    }
}

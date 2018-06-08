<?php

namespace App\Tests\Prosperworks;

use App\Prosperworks\Requester;
use App\Prosperworks\ResourceUtility\NameUpdater;
use PHPUnit\Framework\TestCase;

class NameUpdaterTest extends TestCase
{
    /**
     * @var NameUpdater
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

        $this->fixture = new NameUpdater($this->requester);
    }

    public function testRequesterCalledWithTypeAndId()
    {
        $type = rand();
        $id   = rand();
        $uri  = $type.'/'.$id;

        $this->requester->expects($this->once())
            ->method('getResponse')
            ->with($uri);

        $this->fixture->updateResourceName($type, $id, rand());
    }

    public function testRequesterCalledWithNewName()
    {
        $newName = rand();
        $postFields = "{\n\t\"name\":\"{$newName}\"\n}";

        $this->requester->expects($this->once())
            ->method('getResponse')
            ->with($this->anything(), $postFields);

        $this->fixture->updateResourceName(rand(), rand(), $newName);
    }

    public function testRequesterCalledWithPut()
    {
        $this->requester->expects($this->once())
            ->method('getResponse')
            ->with($this->anything(), $this->anything(), 'PUT');

        $this->fixture->updateResourceName(rand(), rand(), rand());
    }
}

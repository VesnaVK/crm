<?php

namespace App\Tests\Prosperworks;

use App\Prosperworks\Requester;
use PHPUnit\Framework\TestCase;

class RequesterTest extends TestCase
{
    /**
     * @var Requester
     */
    private $fixture = null;

    protected function setUp()
    {
        parent::setup();


        $this->fixture = new Requester();
    }
}

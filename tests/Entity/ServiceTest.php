<?php

namespace App\Tests\Entity;

use App\Entity\Service;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    public function testGetName()
    {
        // we create an instance of Service
        $service = new Service();

        // we assign a name to this instance
        $service->setName('ARCADIA TEST');

        // We check that the method returns the correct value
        $this->assertEquals('ARCADIA TEST', $service->getName());
    }
    public function testGetDescription()
    {
        // we create an instance of Service
        $service = new Service();

        // we assign a description to this instance
        $service->setDescription('Lorem ipsum');

        // We check that the method returns the correct value
        $this->assertEquals('Lorem ipsum', $service->getDescription());
    }
}

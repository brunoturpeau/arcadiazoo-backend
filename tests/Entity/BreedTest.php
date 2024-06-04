<?php

namespace App\Tests\Entity;

use App\Entity\Breed;
use PHPUnit\Framework\TestCase;

class BreedTest extends TestCase
{
    public function testGetName()
    {
        // we create an instance of Breed
        $breed = new Breed();

        // we assign a name to this instance
        $breed->setName('ARCADIA TEST');

        // We check that the method returns the correct value
        $this->assertEquals('ARCADIA TEST', $breed->getName());
    }
    public function testGetDetail()
    {
        // we create an instance of Breed
        $breed = new Breed();

        // we assign a description to this instance
        $breed->setDetail('Lorem ipsum');

        // We check that the method returns the correct value
        $this->assertEquals('Lorem ipsum', $breed->getDetail());
    }
}

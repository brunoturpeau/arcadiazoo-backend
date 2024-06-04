<?php

namespace App\Tests\Entity;

use App\Entity\Animal;
use PHPUnit\Framework\TestCase;

class AnimalTest extends TestCase
{
    public function testGetName()
    {
        // we create an instance of Animal
        $animal = new Animal();

        // we assign a name to this instance
        $animal->setName('ARCADIA TEST');

        // We check that the method returns the correct value
        $this->assertEquals('ARCADIA TEST', $animal->getName());
    }
    public function testGetHealth()
    {
        // we create an instance of Animal
        $animal = new Animal();

        // we assign a string to this instance
        $animal->setHealth('Lorem ipsum');

        // We check that the method returns the correct value
        $this->assertEquals('Lorem ipsum', $animal->getHealth());
    }
}

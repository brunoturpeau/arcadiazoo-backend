<?php

namespace App\Tests\Entity;

use App\Entity\Habitat;
use PHPUnit\Framework\TestCase;

class HabitatTest extends TestCase
{
    public function testGetName()
    {
        // we create an instance of Habitat
        $habitat = new Habitat();

        // we assign a name to this instance
        $habitat->setName('ARCADIA TEST');

        // We check that the method returns the correct value
        $this->assertEquals('ARCADIA TEST', $habitat->getName());
    }
    public function testGetDescription()
    {
        // we create an instance of Habitat
        $habitat = new Habitat();

        // we assign a description to this instance
        $habitat->setDescription('Lorem ipsum');

        // We check that the method returns the correct value
        $this->assertEquals('Lorem ipsum', $habitat->getDescription());
    }
    public function testGetCommentHabitat()
    {
        // we create an instance of Habitat
        $habitat = new Habitat();

        // we assign a description to this instance
        $habitat->setCommentHabitat('Lorem ipsum');

        // We check that the method returns the correct value
        $this->assertEquals('Lorem ipsum', $habitat->getCommentHabitat());
    }
}

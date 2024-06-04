<?php

namespace App\Tests\Entity;

use App\Entity\Breed;
use App\Entity\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testGetTitle()
    {
        // we create an instance of Image
        $image = new Image();

        // we assign a title to this instance
        $image->setTitle('ARCADIA TEST');

        // We check that the method returns the correct value
        $this->assertEquals('ARCADIA TEST', $image->getTitle());
    }

}

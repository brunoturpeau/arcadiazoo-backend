<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {

        for($i = 1; $i <= 12; $i++)
        {
            $image = new Image();
            $image->setTitle('image-'.$i.'.webp');
            $habitat = $this->getReference('habitat-'.rand(1, 3));
            $image->setHabitatId($habitat);
            $animal = $this->getReference('animal-'.rand(1, 20));
            $image->setAnimal($animal);
            $manager->persist($image);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            AnimalFixtures::class
        ];
    }
}

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
        $this->createImageAnimal("5980d8c1336c378a629a5da5a96902dd.webp",'Dundy', 'Dundy', $manager);
        $this->createImageAnimal("3b9d1008ecdcc0c09046a15b70c62eea.webp", 'Dundy','Dundy', $manager);
        $this->createImageAnimal("6519bb327d3465164dce9e312cdf1835.webp",'Simba', 'Simba', $manager);
        $this->createImageAnimal("536805f7f281ee8ee6a8b1065f179119.webp",'Simba', 'Simba', $manager);
        $this->createImageAnimal("02215a25ebce6aee574384ffd80ee9f3.webp",'Simba', 'Zibrou', $manager);
        $this->createImageAnimal("6836e40835a5322b3bd1b91661dd9a4c.webp",'Simba', 'Sheer Khan', $manager);
        $this->createImageAnimal("0d10b57d0df21d5f9dfa5989ed480090.webp",'Simba', 'Ceros', $manager);

        $manager->flush();
    }

    public function createImageAnimal(string $name, string $title, string $refAnimal, ObjectManager $manager)
    {
        $image = new Image();
        $image->setName($name);
        $image->setTitle($title);
        $animal = $this->getReference($refAnimal);
        $image->setAnimal($animal);
        $manager->persist($image);
    }
    public function getDependencies(): array
    {
        return [
            AnimalFixtures::class
        ];
    }
}

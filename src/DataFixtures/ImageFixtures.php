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
        $this->createImageAnimal("da5d45d55c96d92e986268290aa497da.webp", 'Dundy','Dundy', $manager);
        $this->createImageAnimal("5acd69f31f284d71d861a9f688351c84.webp", 'Dundy','Dundy', $manager);
        $this->createImageAnimal("6519bb327d3465164dce9e312cdf1835.webp",'Simba', 'Simba', $manager);
        $this->createImageAnimal("536805f7f281ee8ee6a8b1065f179119.webp",'Simba', 'Simba', $manager);
        $this->createImageAnimal("02215a25ebce6aee574384ffd80ee9f3.webp",'Simba', 'Zibrou', $manager);
        $this->createImageAnimal("6836e40835a5322b3bd1b91661dd9a4c.webp",'Simba', 'Sheer Khan', $manager);
        $this->createImageAnimal("005e62a73ad7ac718c153d4873649a49.webp",'Simba', 'Sheer Khan', $manager);
        $this->createImageAnimal("c75e38c05d4e231a4fe020b68a493b80.webp",'Simba', 'Sheer Khan', $manager);
        $this->createImageAnimal("f2739b868d5614be66a4219d25c16fc3.webp",'Simba', 'Sheer Khan', $manager);
        $this->createImageAnimal("0d10b57d0df21d5f9dfa5989ed480090.webp",'Simba', 'Ceros', $manager);
        $this->createImageAnimal("f5e2f08d020304546c7284c1199559ba.webp",'Adèle', 'Adèle', $manager);
        $this->createImageAnimal("d3c529b8f0a6ea3ca760f55c28ab48e8.webp",'Adèle', 'Adèle', $manager);
        $this->createImageAnimal("e334f7cc7b802e0471469180e56caddb.webp",'Adèle', 'Adèle', $manager);
        $this->createImageAnimal("7d1863aa6303a073b2408bec7f28e14f.webp",'Adèle', 'Adèle', $manager);
        $this->createImageAnimal("e0bade7dbcdacf3fb449189ec7eb712e.webp",'Zibrou', 'Zibrou', $manager);
        $this->createImageAnimal("797a30293f8f7ca971f603c6d2c050a9.webp",'Zibrou', 'Zibrou', $manager);
        $this->createImageAnimal("e0bade7dbcdacf3fb449189ec7eb712e.webp",'Adèle', 'Adèle', $manager);
        $this->createImageAnimal("95ed91fc9b6097d19dcd40369d9bf40d.webp",'Sheila', 'Sheila', $manager);
        $this->createImageAnimal("aed5b0223b5fb972266e0fabd642c279.webp",'Sheila', 'Sheila', $manager);

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

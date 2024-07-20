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
        $this->createImageAnimal("3b9d1008ecdcc0c09046a15b70c62eea.webp", 'Dundy','Dundy', $manager);
        $this->createImageAnimal("da5d45d55c96d92e986268290aa497da.webp", 'Dundy','Dundy', $manager);
        $this->createImageAnimal("5acd69f31f284d71d861a9f688351c84.webp", 'Dundy','Dundy', $manager);
        $this->createImageAnimal("6519bb327d3465164dce9e312cdf1835.webp",'Simba', 'Simba', $manager);
        $this->createImageAnimal("536805f7f281ee8ee6a8b1065f179119.webp",'Simba', 'Simba', $manager);
        $this->createImageAnimal("6836e40835a5322b3bd1b91661dd9a4c.webp",'Sheer Khan', 'Sheer Khan', $manager);
        $this->createImageAnimal("005e62a73ad7ac718c153d4873649a49.webp",'Sheer Khan', 'Sheer Khan', $manager);
        $this->createImageAnimal("c75e38c05d4e231a4fe020b68a493b80.webp",'Sheer Khan', 'Sheer Khan', $manager);
        $this->createImageAnimal("f2739b868d5614be66a4219d25c16fc3.webp",'Sheer Khan', 'Sheer Khan', $manager);
        $this->createImageAnimal("0d10b57d0df21d5f9dfa5989ed480090.webp",'Ceros', 'Ceros', $manager);
        $this->createImageAnimal("f5e2f08d020304546c7284c1199559ba.webp",'Adèle', 'Adèle', $manager);
        $this->createImageAnimal("d3c529b8f0a6ea3ca760f55c28ab48e8.webp",'Adèle', 'Adèle', $manager);
        $this->createImageAnimal("e334f7cc7b802e0471469180e56caddb.webp",'Adèle', 'Adèle', $manager);
        $this->createImageAnimal("7d1863aa6303a073b2408bec7f28e14f.webp",'Adèle', 'Adèle', $manager);
        $this->createImageAnimal("02215a25ebce6aee574384ffd80ee9f3.webp",'Zibrou', 'Zibrou', $manager);
        $this->createImageAnimal("797a30293f8f7ca971f603c6d2c050a9.webp",'Zibrou', 'Zibrou', $manager);
        $this->createImageAnimal("e0bade7dbcdacf3fb449189ec7eb712e.webp",'Zibrou', 'Adèle', $manager);
        $this->createImageAnimal("95ed91fc9b6097d19dcd40369d9bf40d.webp",'Sheila', 'Sheila', $manager);
        $this->createImageAnimal("aed5b0223b5fb972266e0fabd642c279.webp",'Sheila', 'Sheila', $manager);
        $this->createImageAnimal("434a33530d73197051b101a4e1604f1e.webp",'Fifi', 'Fifi', $manager);
        $this->createImageAnimal("6bf7d012d316c950f874569f668d97b1.webp",'Fifi', 'Fifi', $manager);
        $this->createImageAnimal("c810e7adfb06770452e55c3d8666b20b.webp",'Fanny', 'Fanny', $manager);
        $this->createImageAnimal("08fdd981dad87050b408c41759009a8d.webp",'Biscus', 'Biscus', $manager);
        $this->createImageAnimal("15e6636bd02920c0a665621db8f3f9dc.webp",'Ibizou', 'Ibizou', $manager);
        $this->createImageAnimal("1f7e30b40583c1a9ed4fb9b11b060d22.webp",'Ibizou', 'Ibizou', $manager);
        $this->createImageAnimal("0b95c19ebeb0d5978515d6c303fed299.webp",'Aligato', 'Aligato', $manager);
        $this->createImageAnimal("3b9d1008ecdcc0c09046a15b70c62eea.webp",'Aligato', 'Aligato', $manager);
        $this->createImageAnimal("c4de56859d38947da639f3976016703d.webp",'Alix', 'Alix', $manager);
        $this->createImageAnimal("40f8aed861dd7206807e7bea417dc67.webp",'Alix', 'Alix', $manager);

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

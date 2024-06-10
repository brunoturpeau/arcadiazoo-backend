<?php

namespace App\DataFixtures;

use App\Entity\SuggestFeeding;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SuggestFeadingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $suggest = new SuggestFeeding();
        $suggest->setFeeding('feeding-1');
        $suggest->setQuantity(1250);
        $user = $this->getReference('user-3');
        $suggest->setUser($user);
        $animal = $this->getReference("Sheila");
        $suggest->setAnimal($animal);

        $manager->persist($suggest);

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            AnimalFixtures::class
        ];
    }
}

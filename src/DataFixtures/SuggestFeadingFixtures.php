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
        $this->createSuggestFeeding('lapin',3000,'user-3','Dundy',$manager);
        $this->createSuggestFeeding('Boeuf',5000,'user-3','Dundy',$manager);
        $this->createSuggestFeeding('Fourrage',5000,'user-3','Adèle',$manager);
        $this->createSuggestFeeding('Viandes diverses',5000,'user-3','Sheila',$manager);
        $this->createSuggestFeeding('Viandes diverses',7000,'user-3','Simba',$manager);
        $this->createSuggestFeeding('Viandes diverses',7000,'user-3','Sheer Khan',$manager);


        $manager->flush();
    }

    public function createSuggestFeeding(string $feeding, int $quantity, $user, $animal, ObjectManager $manager)
    {
        $suggest = new SuggestFeeding();
        $suggest->setFeeding($feeding);
        $suggest->setQuantity($quantity);
        $user = $this->getReference($user);
        $suggest->setUser($user);
        $animal = $this->getReference($animal);
        $suggest->setAnimal($animal);

        $manager->persist($suggest);
    }
    public function getDependencies(): array
    {
        return [
            AnimalFixtures::class
        ];
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Eating;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class EatingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $this->createEating('poulet',5000,'Dundy_repas_1', $manager);
        $this->createEating('boeuf',5000,'Dundy_repas_1', $manager);
        $this->createEating('poulet',1250,'Dundy_repas_2', $manager);
        $this->createEating('boeuf',5000,'Dundy_repas_2', $manager);

        $this->createEating("Feuilles d'acacia",30000,'Adele_repas_1', $manager);
        $this->createEating('Fruits et graines',5000,'Adele_repas_1', $manager);
        $this->createEating("Feuilles d'acacia",30000,'Adele_repas_2', $manager);
        $this->createEating('Fruits et graines',5000,'Adele_repas_2', $manager);


        $manager->flush();
    }

    public function createEating(string $feeding, int $quantity, string $food, ObjectManager $manager){

        $eating = new Eating();
        $eating->setFeeding($feeding);
        $eating->setQuantity($quantity);

        $food = $this->getReference($food);
        $eating->setFood($food);

        $manager->persist($eating);
    }
    public function getDependencies(): array
    {
        return [
            FoodFixtures::class
        ];
    }
}

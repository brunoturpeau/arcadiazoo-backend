<?php

namespace App\DataFixtures;

use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class FoodFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:00:00'),'Dundy', 'Dundy_repas_1', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:00:00'),'Dundy', 'Dundy_repas_2', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:00:00'),'Dundy', 'Dundy_repas_3', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:00:00'),'Simba', 'Simba_repas_1', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:00:00'),'Simba', 'Simba_repas_2', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:00:00'),'Simba', 'Simba_repas_3', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('11:00:00'),'Simba', 'Simba_repas_4', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:00:00'),'Zibrou', 'Zibrou_repas_1', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:00:00'),'Zibrou', 'Zibrou_repas_2', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:00:00'),'Zibrou', 'Zibrou_repas_3', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('11:00:00'),'Zibrou', 'Zibrou_repas_4', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:00:00'),'Sheer Khan', 'Sheer Khan_repas_1', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:00:00'),'Sheer Khan', 'Sheer Khan_repas_2', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:00:00'),'Sheer Khan', 'Sheer Khan_repas_3', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('11:00:00'),'Sheer Khan', 'Sheer Khan_repas_4', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:00:00'),'Ceros', 'Ceros_repas_1', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:00:00'),'Ceros', 'Ceros_repas_2', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:00:00'),'Ceros', 'Ceros_repas_3', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('11:00:00'),'Ceros', 'Ceros_repas_4', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:30:00'),'Adèle', 'Adèle_repas_1', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:30:00'),'Adèle', 'Adèle_repas_2', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:30:00'),'Adèle', 'Adèle_repas_3', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('11:30:00'),'Adèle', 'Adèle_repas_4', $manager);

        $manager->flush();
    }

    public function createFood($date, $updatedAt, $time, string $animal, string $reference,  ObjectManager $manager){

        $food = new Food();
        $food->setCreatedAt($date);
        $food->setUpdatedAt($updatedAt);
        $food->setTime($time);
        $animal = $this->getReference($animal);
        $food->setAnimal($animal);
        $food->setSlug('repas-'.rand(1, 99999999));
        $this->addReference($reference, $food);

        $manager->persist($food);
    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}

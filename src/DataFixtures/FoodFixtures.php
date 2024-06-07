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
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:00:00'),'Dundy', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:00:00'),'Dundy', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:00:00'),'Dundy', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:00:00'),'Simba', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:00:00'),'Simba', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:00:00'),'Simba', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('11:00:00'),'Simba', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:00:00'),'Zibrou', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:00:00'),'Zibrou', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:00:00'),'Zibrou', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('11:00:00'),'Zibrou', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:00:00'),'Sheer Khan', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:00:00'),'Sheer Khan', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:00:00'),'Sheer Khan', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('11:00:00'),'Sheer Khan', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:00:00'),'Ceros', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:00:00'),'Ceros', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:00:00'),'Ceros', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('11:00:00'),'Ceros', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('2024-09-01'),new \DateTimeImmutable('11:30:00'),'Adèle', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('2024-09-02'),new \DateTimeImmutable('11:30:00'),'Adèle', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('2024-09-03'),new \DateTimeImmutable('11:30:00'),'Adèle', $manager);
        $this->createFood(new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('2024-09-04'),new \DateTimeImmutable('11:30:00'),'Adèle', $manager);

        $manager->flush();
    }

    public function createFood($date, $updatedAt, $time, string $animal,  ObjectManager $manager){

        $food = new Food();
        $food->setCreatedAt($date);
        $food->setUpdatedAt($updatedAt);
        $food->setTime($time);
        $animal = $this->getReference($animal);
        $food->setAnimal($animal);

        $manager->persist($food);
    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}

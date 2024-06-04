<?php

namespace App\DataFixtures;

use App\Entity\Report;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ReportFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 50; $i++)
        {
            $report = new Report();
            $report->setDetail($faker->text(50));
            $user = $this->getReference('user-'.rand(3, 6));
            $report->setUser($user);
            $animal = $this->getReference('animal-'.rand(1, 30));
            $report->setAnimal($animal);

            $manager->persist($report);
        }


        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}

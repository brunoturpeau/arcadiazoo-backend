<?php

namespace App\DataFixtures;

use App\Entity\Report;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReportFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $this->createReport(new \DateTimeImmutable('2024-08-01'), 'Rapport texte','user-3','Dundy', $manager);
        $this->createReport(new \DateTimeImmutable('2024-08-05'), 'Rapport texte','user-5','Dundy', $manager);
        $this->createReport(new \DateTimeImmutable('2024-08-17'), 'Rapport texte','user-3','Zibrou', $manager);
        $this->createReport(new \DateTimeImmutable('2024-08-12'), 'Rapport texte','user-5','Zibrou', $manager);
        $this->createReport(new \DateTimeImmutable('2024-08-24'), 'Rapport texte','user-3','Zibrou', $manager);
        $this->createReport(new \DateTimeImmutable('2024-08-24'), 'Rapport texte','user-3','Zibrou', $manager);

        $manager->flush();
    }
    public function createReport($date, string $detail, $user, $animal, ObjectManager $manager)
    {
        $report = new Report();
        $report->setDate($date);
        $user = $this->getReference($user);
        $report->setUser($user);
        $report->setDetail($detail);
        $animal = $this->getReference($animal);
        $report->setAnimal($animal);

        $manager->persist($report);
    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}

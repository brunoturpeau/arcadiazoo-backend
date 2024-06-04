<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class ServiceFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $service = new Service();
        $service->setName('Restauration');
        $service->setDescription($faker->text);
        $service->setSlug($this->slugger->slug($service->getName())->lower());

        $manager->persist($service);

        $service = new Service();
        $service->setName('Visite guidée');
        $service->setDescription($faker->text);
        $service->setSlug($this->slugger->slug($service->getName())->lower());

        $manager->persist($service);

        $service = new Service();
        $service->setName('Visite en petit train');
        $service->setDescription($faker->text);
        $service->setSlug($this->slugger->slug($service->getName())->lower());

        $manager->persist($service);
        $manager->flush();
    }
}

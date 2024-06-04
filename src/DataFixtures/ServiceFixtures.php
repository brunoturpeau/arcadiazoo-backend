<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ServiceFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {

        $service = new Service();
        $service->setName('Restauration');
        $service->setDescription('Savourez une pause au cœur de la jungle avec notre restaurant au zoo. Des mets exotiques aux classiques appréciés des familles, notre menu éveille les papilles. Détendez-vous entre deux explorations et rechargez vos batteries dans notre oasis gastronomique.');
        $service->setSlug($this->slugger->slug($service->getName())->lower());
        $manager->persist($service);

        $service = new Service();
        $service->setName('Visite guidée');
        $service->setDescription('Explorez notre zoo de manière experte avec nos visites guidées gratuites. Nos guides passionnés vous emmènent dans un voyage captivant à la découverte de nos résidents à poils, plumes et écailles. Une immersion éducative pour toute la famille, sans frais supplémentaires.');
        $service->setSlug($this->slugger->slug($service->getName())->lower());
        $manager->persist($service);

        $service = new Service();
        $service->setName('Visite en petit train');
        $service->setDescription('Parcourez notre vaste domaine à bord de notre train safari. Glissez à travers les habitats animaliers dans le confort de nos wagons, écoutant les histoires captivantes de nos conducteurs. Une aventure inoubliable pour découvrir les merveilles de la faune mondiale, sans effort.');
        $service->setSlug($this->slugger->slug($service->getName())->lower());
        $manager->persist($service);

        $manager->flush();
    }
}

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
        $this->createService('Restauration',"Savourez une pause au cœur de la jungle avec notre restaurant au zoo. Des mets exotiques aux classiques appréciés des familles, notre menu éveille les papilles. Détendez-vous entre deux explorations et rechargez vos batteries dans notre oasis gastronomique.", $manager);
        $this->createService('Visite guidée',"Explorez notre zoo de manière experte avec nos visites guidées gratuites. Nos guides passionnés vous emmènent dans un voyage captivant à la découverte de nos résidents à poils, plumes et écailles. Une immersion éducative pour toute la famille, sans frais supplémentaires.",$manager);
        $this->createService('Visite en petit train',"Parcourez notre vaste domaine à bord de notre train safari. Glissez à travers les habitats animaliers dans le confort de nos wagons, écoutant les histoires captivantes de nos conducteurs. Une aventure inoubliable pour découvrir les merveilles de la faune mondiale, sans effort.",$manager);
        $this->createService('Spectacle de Perroquets',"Le zoo propose un spectacle d’otaries captivant, à ne pas manquer, se déroulant à 11h00, 15h00 et 17h00 chaque jour. Ces charmantes créatures marines exécutent des tours impressionnants, alliant acrobaties et jeux d’adresse, pour le plus grand plaisir des spectateurs. Le spectacle est une expérience éducative et divertissante, mettant en valeur l’intelligence et la grâce des otaries tout en sensibilisant à la conservation des espèces marines.", $manager);

        $manager->flush();
    }
    public function createService(string $name, string $description, ObjectManager $manager)
    {
        $service = new Service();
        $service->setName($name);
        $service->setDescription($description);
        $service->setSlug($this->slugger->slug($service->getName())->lower());
        $manager->persist($service);
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;
class AnimalFixtures extends Fixture implements DependentFixtureInterface
{
    private $counter = 1;
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $this->createAnimal("Adèle",'En très bonne forme', 'Girafe', 'Savane', $manager);
        $this->createAnimal("Dundy",'En très bonne forme', 'Crocodile', 'Marais', $manager);
        $this->createAnimal("Simba",'En très bonne forme', 'Lion', 'Savane', $manager);
        $this->createAnimal("Zibrou",'En très bonne forme', 'Zèbre', 'Savane', $manager);
        $this->createAnimal("Sheer Khan",'En très bonne forme', 'Tigre', 'Jungle', $manager);
        $this->createAnimal("Ceros",'En très bonne forme', 'Rhinocéros blanc', 'Jungle', $manager);




        $manager->flush();
    }
    public function createAnimal(string $name, string $health, string $breed, string $habitat, ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $animal = new Animal();
        $animal->setName($name);
        $animal->setDescription($faker->text(150));
        $animal->setHealth($health);
        $animal->setSlug($this->slugger->slug($animal->getName())->lower());
        $habitat = $this->getReference($habitat);
        $animal->setHabitat($habitat);
        $breed = $this->getReference($breed);
        $animal->setBreed($breed);
        $manager->persist($animal);
        $this->addReference($animal->getName(), $animal);
    }
    public function getDependencies(): array
    {
        return [
            BreedFixtures::class
        ];
    }
}

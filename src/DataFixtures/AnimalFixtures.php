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
        $this->createAnimal("Dundy",$faker->text(120),'En très bonne forme', 'Crocodile', 'Marais', $manager);
        $this->createAnimal("Simba",$faker->text(90),'En très bonne forme', 'Lion', 'Savane', $manager);
        $this->createAnimal("Zibrou",$faker->text(80),'En très bonne forme', 'Zèbre', 'Savane', $manager);
        $this->createAnimal("Sheer Khan",$faker->text(110),'En très bonne forme', 'Tigre', 'Jungle', $manager);
        $this->createAnimal("Ceros",$faker->text(100),'En très bonne forme', 'Rhinocéros blanc', 'Jungle', $manager);



        for ($i = 1; $i <= 50; $i++){
            $animal = new Animal();
            $animal->setName($faker->firstName());
            $animal->setHealth($faker->text(30));
            $animal->setSlug($this->slugger->slug($animal->getName())->lower());
            $habitat = $this->getReference('Jungle');
            $animal->setHabitat($habitat);
            $breed = $this->getReference('breed-'.rand(1, 10));
            $animal->setBreed($breed);

            $manager->persist($animal);

            $this->addReference('animal-'.$this->counter, $animal);
            $this->counter++;
        }

        $manager->flush();
    }
    public function createAnimal(string $name,string $description, string $health, string $breed, string $habitat, ObjectManager $manager)
    {
        $animal = new Animal();
        $animal->setName($name);
        $animal->setDescription($description);
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

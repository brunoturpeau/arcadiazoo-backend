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
        for ($i = 1; $i <= 50; $i++){
            $animal = new Animal();
            $animal->setName('animal-'.$i);
            $animal->setHealth($faker->text(30));
            $animal->setSlug($this->slugger->slug($animal->getName())->lower());
            $breed = $this->getReference('breed-'.rand(1, 10));
            $animal->setBreed($breed);
            $manager->persist($animal);

            $this->addReference('animal-'.$this->counter, $animal);
            $this->counter++;
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            BreedFixtures::class
        ];
    }
}

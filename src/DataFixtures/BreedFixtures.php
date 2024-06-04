<?php

namespace App\DataFixtures;

use App\Entity\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class BreedFixtures extends Fixture
{
    private $counter = 1;
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR');

        for($i = 1; $i <= 30; $i++)
        {
            $breed = new Breed();
            $breed->setName('Race-'.$i);
            $breed->setSlug($this->slugger->slug($breed->getName())->lower());
            $breed->setDetail($faker->text);
            $manager->persist($breed);

            $this->addReference('breed-'.$this->counter, $breed);
            $this->counter++;
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Habitat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class HabitatFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $habitat = new Habitat();
        $habitat->setName('SAVANE');
        $habitat->setSlug($this->slugger->slug($habitat->getName())->lower());
        $habitat->setDescription($faker->text(150));
        $habitat->setCommentHabitat($faker->text(50));
        $manager->persist($habitat);
        $this->addReference('habitat-1', $habitat);

        $habitat = new Habitat();
        $habitat->setName('MARAIS');
        $habitat->setSlug($this->slugger->slug($habitat->getName())->lower());
        $habitat->setDescription($faker->text(150));
        $habitat->setCommentHabitat($faker->text(50));
        $manager->persist($habitat);
        $this->addReference('habitat-2', $habitat);

        $habitat = new Habitat();
        $habitat->setName('JUNGLE');
        $habitat->setSlug($this->slugger->slug($habitat->getName())->lower());
        $habitat->setDescription($faker->text(150));
        $habitat->setCommentHabitat($faker->text(50));
        $manager->persist($habitat);
        $this->addReference('habitat-3', $habitat);

        $manager->flush();
    }
}

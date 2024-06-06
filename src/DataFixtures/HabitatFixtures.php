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
        $habitat->setName('Savane');
        $habitat->setSlug($this->slugger->slug($habitat->getName())->lower());
        $habitat->setDescription("La savane africaine, reconstitution souvent vue en zoos, abrite une multitude d'espèces emblématiques. Lions majestueux, éléphants imposants, girafes gracieuses, zèbres rayés, rhinocéros massifs, guépards rapides et hyènes rusées évoquent un monde sauvage captivant, offrant aux visiteurs une immersion unique dans la beauté et la diversité de la nature africaine.");
        $habitat->setCommentHabitat($faker->text(50));
        $manager->persist($habitat);
        $this->addReference('Savane', $habitat);

        $habitat = new Habitat();
        $habitat->setName('Marais');
        $habitat->setSlug($this->slugger->slug($habitat->getName())->lower());
        $habitat->setDescription("Les marais abritent une biodiversité unique, souvent recréée dans les zoos. Crocodiles furtifs, alligators solitaires, tortues aquatiques, serpents glissants, grenouilles colorées et hérons élégants évoquent un écosystème vibrant. Ces créatures captivantes offrent aux visiteurs une exploration immersive des habitats humides et de leur fascinante faune.");
        $habitat->setCommentHabitat($faker->text(50));
        $manager->persist($habitat);
        $this->addReference('Marais', $habitat);

        $habitat = new Habitat();
        $habitat->setName('Jungle');
        $habitat->setSlug($this->slugger->slug($habitat->getName())->lower());
        $habitat->setDescription("La jungle, source d'émerveillement, trouve son reflet dans les zoos. Lions rugissants, tigres rayés, singes espiègles, serpents sinueux, perroquets colorés et toucans exotiques évoquent une biodiversité luxuriante. Ces ambassadeurs de la jungle offrent aux visiteurs une immersion palpitante dans les mystères et la splendeur de ces habitats tropicaux.");
        $habitat->setCommentHabitat($faker->text(50));
        $manager->persist($habitat);
        $this->addReference('Jungle', $habitat);

        $manager->flush();
    }
}

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
        $this->createBreed("Lion","Le lion d'Afrique, majestueux prédateur des savanes, est connu pour sa crinière distinctive et son rugissement puissant. Vivant en groupes appelés fiertés, il joue un rôle crucial dans l'écosystème. Menacé par la perte d'habitat et le braconnage, il incarne la beauté et la fragilité de la faune sauvage.", $manager);
        $this->createBreed("Éléphant d'Afrique","L'éléphant d'Afrique, le plus grand mammifère terrestre, est connu pour ses grandes oreilles et sa trompe polyvalente. Vivant en groupes familiaux, il joue un rôle écologique crucial. Menacé par le braconnage et la perte d'habitat, sa conservation est vitale", $manager);
        $this->createBreed("Girafe","La girafe, avec son long cou et ses pattes élancées, est l'animal terrestre le plus grand. Elle se nourrit principalement des feuilles d'acacia dans les savanes africaines. Sociable et pacifique, la girafe est menacée par la perte d'habitat et le braconnage, nécessitant des efforts de conservation pour sa survie.", $manager);
        $this->createBreed("Zèbre","Le zèbre, reconnaissable à ses rayures noires et blanches uniques, vit en troupeaux dans les savanes africaines. Herbivore, il se nourrit principalement d'herbes. Les rayures offrent un camouflage contre les prédateurs. Menacé par la perte d'habitat et le braconnage, sa conservation est essentielle pour préserver cette espèce emblématique.", $manager);
        $this->createBreed("Guépard","", $manager);
        $this->createBreed("Rhinocéros blanc","", $manager);
        $this->createBreed("Hyène tachetée","", $manager);
        $this->createBreed("Gnou bleu","", $manager);
        $this->createBreed("Tigre","Le tigre, majestueux grand félin aux rayures distinctives, est un prédateur solitaire des jungles et forêts d'Asie. Il chasse principalement des cerfs et des sangliers. Menacé par la déforestation, la fragmentation de l'habitat et le braconnage, le tigre symbolise la beauté sauvage et la nécessité de la conservation.", $manager);
        $this->createBreed("Singe hurleur","", $manager);
        $this->createBreed("Jaguar","", $manager);
        $this->createBreed("Paresseux","", $manager);
        $this->createBreed("Boa constricteur","", $manager);
        $this->createBreed("Perroquet ara","", $manager);
        $this->createBreed("Léopard","", $manager);
        $this->createBreed("Fourmilier géant","", $manager);
        $this->createBreed("Crocodile","Le crocodile, redoutable prédateur des marais et rivières, possède une mâchoire puissante et une armure écailleuse. Excellent nageur, il chasse discrètement en embuscade. Présent depuis des millions d'années, il incarne la résilience et la force de la nature. Sa conservation est essentielle face aux menaces humaines.", $manager);
        $this->createBreed("Alligator","", $manager);
        $this->createBreed("Tortue de Floride","", $manager);
        $this->createBreed("Héron cendré","", $manager);
        $this->createBreed("Ibis","", $manager);
        $this->createBreed("Rat musqué","", $manager);
        $this->createBreed("Grenouille taureau","", $manager);
        $this->createBreed("Serpent d'eau","", $manager);
        $this->createBreed("Castor","", $manager);
        $this->createBreed("Canard colvert","", $manager);

        $faker = Faker\Factory::create('fr_FR');



        $manager->flush();
    }
    public function createBreed(string $name, string $detail, ObjectManager $manager)
    {
        $breed = new Breed();
        $breed->setName($name);
        $breed->setSlug($this->slugger->slug($breed->getName())->lower());
        $breed->setDetail($detail);
        $manager->persist($breed);
        $this->addReference($breed->getName(), $breed);
    }
}

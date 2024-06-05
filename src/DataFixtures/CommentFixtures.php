<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $this->createComment("Famille Campion", "Une expérience extraordinaire ! Le zoo offre une immersion totale dans la vie sauvage. Les animations éducatives et la proximité avec les animaux sont incomparables. Une journée inoubliable pour les petits et les grands !",new \DateTimeImmutable('2000-01-01'), $manager);
        $this->createComment("Rocket 79", "Quelle façon fantastique de visiter le zoo en famille ! Le petit train nous a permis de découvrir tous les recoins du parc sans fatigue. Les enfants étaient ravis de voir les animaux de si près. Une expérience vraiment mémorable pour toute la famille !", new \DateTimeImmutable('2000-01-01'), $manager);
        $this->createComment("PapyGato", "Une visite enrichissante et écologique ! Ce zoo se distingue par son engagement envers la conservation et l\'éducation environnementale. Les habitats naturels et les programmes de préservation sont remarquables.", new \DateTimeImmutable('2000-01-01'), $manager);

        $manager->flush();
    }
    public function createComment(string $pseudo, ?string $commentText, $date, ObjectManager $manager)
    {
        $comment = new Comment();
        $comment->setPseudo($pseudo);
        $comment->setCommentText($commentText);
        $comment->setVisible(1);
        $manager->persist($comment);
    }
}

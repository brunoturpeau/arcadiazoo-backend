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

        for ($i = 1; $i <= 30; $i++){
            $comment = new Comment();
            $comment->setPseudo($faker->text(10));
            $comment->setCommentText($faker->text(150));
            $comment->setVisible(rand(0,1));
            $manager->persist($comment);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for($i=1; $i < 50; $i++) {
            $comment = new Comment();
            $comment->setAuthor($i);
            $comment->setPost();
            $comment->setComment($faker->realText(150));
            $manager->persist($comment);
        }
        $manager->flush();
    }
}

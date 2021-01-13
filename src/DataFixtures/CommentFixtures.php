<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for($i=0; $i < 11; $i++) {
            $comment = new Comment();
            $comment->setUser($this->getReference('user_' . $i));
            $comment->setPost($this->getReference('post_' . $i));
            $comment->setComment($faker->realText(150));
            $manager->persist($comment);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class, PostFixtures::class];
    }
}

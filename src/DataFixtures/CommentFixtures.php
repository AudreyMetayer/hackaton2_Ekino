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


        $comment = new Comment();
        $comment->setUser($this->getReference('user_7'));
        $comment->setPost($this->getReference('post_1'));
        $comment->setComment('Qu\'est -ce qui est petit et marron ?');
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser($this->getReference('user_9'));
        $comment->setPost($this->getReference('post_2'));
        $comment->setComment('"Les chicots, c\'est sacré ! Parce que si j\'les lave pas maintenant, dans dix ans, c\'est tout à la soupe. Et l\'mec qui me fera manger de la soupe il est pas né !"
 ?');
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser($this->getReference('user_10'));
        $comment->setPost($this->getReference('post_3'));
        $comment->setComment('"Faut arrêter ces conneries de nord et de sud ! Une fois pour toutes, le nord, suivant comment on est tourné, ça change tout !"?');
        $manager->persist($comment);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser($this->getReference('user_2'));
        $comment->setPost($this->getReference('post_4'));
        $comment->setComment('Récupères Tamise');
        $manager->persist($comment);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser($this->getReference('user_4'));
        $comment->setPost($this->getReference('post_4'));
        $comment->setComment('tu étais à londres du soleil?');
        $manager->persist($comment);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser($this->getReference('user_3'));
        $comment->setPost($this->getReference('post_5'));
        $comment->setComment('Te noix pas !');
        $manager->persist($comment);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser($this->getReference('user_5'));
        $comment->setPost($this->getReference('post_5'));
        $comment->setComment('Je connais cet endroit');
        $manager->persist($comment);
        $manager->persist($comment);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class, PostFixtures::class];
    }
}

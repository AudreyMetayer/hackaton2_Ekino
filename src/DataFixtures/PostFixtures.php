<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $post = new Post();
        $post->setLegend('Le gras c\'est la vie');
        $post->setUser($this->getReference('user_9'));
        $post->setPicture('karadoc.jpeg');
        $post->setSalon($this->getReference('salon_1'));
        $manager->persist($post);
        $this->addReference('post_1', $post);

        $post = new Post();
        $post->setLegend('C\'est pas faux !');
        $post->setUser($this->getReference('user_10'));
        $post->setPicture('perceval.jpg');
        $post->setSalon($this->getReference('salon_1'));
        $manager->persist($post);
        $this->addReference('post_2', $post);

        $post = new Post();
        $post->setLegend('J\'ai pas touchéo !');
        $post->setUser($this->getReference('user_7'));
        $post->setPicture('merlin.jpg');
        $post->setSalon($this->getReference('salon_1'));
        $manager->persist($post);
        $this->addReference('post_3', $post);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class, SalonFixtures::class];
    }
}

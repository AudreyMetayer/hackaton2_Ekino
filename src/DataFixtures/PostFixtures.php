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
        $faker  =  Faker\Factory::create('fr_FR');
        for($i=0; $i < 11; $i++) {
            $post = new Post();
            $post->setLegend($faker->title);
            $post->setUser($this->getReference('user_' . $i));
            $post->setPicture('https://loremflickr.com/320/640/all');
            $post->setSalon($this->getReference('salon_' . (rand(0,1))));
            $manager->persist($post);
            $this->addReference('post_' . $i, $post);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class, SalonFixtures::class];
    }
}

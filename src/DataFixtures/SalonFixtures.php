<?php

namespace App\DataFixtures;

use App\Entity\Salon;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SalonFixtures extends Fixture implements DependentFixtureInterface
{
    const SALONS = [
        'Mes potos',
        'Ma famille',
    ];

    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $i=0;
        foreach (self::SALONS as $salonData) {
            $salon = new Salon();
            $salon->setName($salonData);
            $salon->setPicture('https://loremflickr.com/320/640/all');
            $salon->addTheme($this->getReference('theme_' . (rand(0,1))));
            $salon->setSlug($this->slugify->generate($salonData));
            for ($j= 0; $j <= rand(1,6); $j++) {
                $salon->addUser($this->getReference('user_' . rand(0,10)));
            }
            $salon->addUser($this->getReference('user_10'));
            $manager->persist($salon);
            $this->addReference('salon_' . ($i), $salon);
            $i++;
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [ThemeFixtures::class];
    }
}

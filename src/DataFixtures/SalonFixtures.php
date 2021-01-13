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
        for($i=1; $i < (count(self::SALONS)); $i++) {
            foreach (self::SALONS as $salonData) {
                $salon = new Salon();
                $salon->setName($salonData);
                $salon->setPicture('https://loremflickr.com/320/640/all');
                $salon->addTheme($this->getReference('theme_' . (rand(0,1))));
                $salon->setSlug($this->slugify->generate($salonData));
                $manager->persist($salon);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ThemeFixtures::class];
    }
}

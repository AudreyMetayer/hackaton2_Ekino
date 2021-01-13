<?php

namespace App\DataFixtures;

use App\Entity\Salon;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SalonFixtures extends Fixture
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
                $salon->addTheme($this->getReference('theme_' . ($i)));
                $salon->setSlug($this->slugify->generate($salonData) . '-' . rand(100,200));
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

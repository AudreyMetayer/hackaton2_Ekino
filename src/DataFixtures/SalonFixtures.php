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

        'Les PHPix de la Wild',
        'La table ronde',

    ];

    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {


        $salon = new Salon();
        $salon->setName(self::SALONS[0]);
        $salon->setPicture('phpix.jpg');
        $salon->addTheme($this->getReference('theme_5'));
        $salon->setSlug($this->slugify->generate(self::SALONS[0]));
        $manager->persist($salon);
        $this->addReference('salon_0', $salon);

        $salon = new Salon();
        $salon->setName(self::SALONS[1]);
        $salon->setPicture('tableronde.jpg');
        $salon->addTheme($this->getReference('theme_3'));
        $salon->setSlug($this->slugify->generate(self::SALONS[1]));
        $manager->persist($salon);
        $this->addReference('salon_1', $salon);



        $manager->flush();
    }

    public function getDependencies()
    {
        return [ThemeFixtures::class];
    }
}

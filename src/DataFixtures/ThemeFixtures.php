<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ThemeFixtures extends Fixture
{
    const THEME = [
        'Tong Chaussette à la plage',
        'Ton pire profil',
    ];

    public function load(ObjectManager $manager)
    {
        $i = 1;
        foreach (self::THEME as $themeData) {
            $theme = new Theme();
            $theme->setTheme($themeData);
            $manager->persist($theme);
            $this->addReference('theme_' . $i, $theme);
            $i++;
        }

        $manager->flush();
    }
}

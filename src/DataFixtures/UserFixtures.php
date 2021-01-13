<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for($i=0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($faker->firstName);
            $user->setEmail($faker->email);
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'MyPassword_' . $i));
            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
        }

        $user = new User();
        $user->setUsername('Georges');
        $user->setEmail('test@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $manager->persist($user);
        $this->addReference('user_10', $user);

        $manager->flush();
    }
}

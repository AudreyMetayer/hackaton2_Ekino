<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');


        $user = new User();
        $user->setUsername('G-Harari');
        $user->setEmail('test@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->addSalon($this->getReference('salon_0'));
        $user->addSalon($this->getReference('salon_1'));
        $manager->persist($user);
        $this->addReference('user_1', $user);

        $user = new User();
        $user->setUsername('Provencal');
        $user->setEmail('test10@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->addSalon($this->getReference('salon_1'));
        $manager->persist($user);
        $this->addReference('user_10', $user);

        $user = new User();
        $user->setUsername('Yacine');
        $user->setEmail('test2@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->addSalon($this->getReference('salon_0'));
        $manager->persist($user);
        $this->addReference('user_2', $user);

        $user = new User();
        $user->setUsername('Geoffrey');
        $user->setEmail('test3@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->addSalon($this->getReference('salon_0'));
        $manager->persist($user);
        $this->addReference('user_3', $user);

        $user = new User();
        $user->setUsername('Seb');
        $user->setEmail('test4@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->addSalon($this->getReference('salon_0'));
        $manager->persist($user);
        $this->addReference('user_4', $user);

        $user = new User();
        $user->setUsername('Manu');
        $user->setEmail('test5@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->addSalon($this->getReference('salon_0'));
        $manager->persist($user);
        $this->addReference('user_5', $user);

        $user = new User();
        $user->setUsername('Audrey');
        $user->setEmail('test6@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->addSalon($this->getReference('salon_0'));
        $manager->persist($user);
        $this->addReference('user_6', $user);

        $user = new User();
        $user->setUsername('Karadoc');
        $user->setEmail('test9@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->addSalon($this->getReference('salon_1'));
        $manager->persist($user);
        $this->addReference('user_9', $user);

        $user = new User();
        $user->setUsername('Léodagan');
        $user->setEmail('test8@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->addSalon($this->getReference('salon_1'));
        $manager->persist($user);
        $this->addReference('user_8', $user);

        $user = new User();
        $user->setUsername('Merlin');
        $user->setEmail('test7@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->addSalon($this->getReference('salon_1'));
        $manager->persist($user);
        $this->addReference('user_7', $user);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [SalonFixtures::class];
    }
}

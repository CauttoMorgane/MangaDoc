<?php
// src/DataFixtures/UserFixtures.php

namespace App\DataFixtures;

use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $em)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            if ($i == 1) {
                $user
                    ->setFirstname($faker->firstName)
                    ->setLastname($faker->lastName)
                    ->setCity($faker->city)
                    ->setCountry($faker->country)
                    ->setGender('Femme')
                    ->setPayment('Cheque Espece Virement')
                    ->setNickname('Admin')
                    ->setPassword($this->passwordEncoder->encodePassword($user, 'admin'))
                    ->setEmail('admin@test.test')
                    ->setRoles(['ROLE_ADMIN']);
            } else {
                $user
                    ->setFirstname($faker->firstName)
                    ->setLastname($faker->lastName)
                    ->setCity($faker->city)
                    ->setCountry($faker->country)
                    ->setGender('Femme')
                    ->setPayment('Cheque Espece Virement')
                    ->setNickname($faker->name)
                    ->setPassword($this->passwordEncoder->encodePassword($user, 'user'))
                    ->setEmail($faker->email)
                    ->setRoles(['ROLE_USER']);
            }
            $em->persist($user);
        }
        $em->flush();
    }
}

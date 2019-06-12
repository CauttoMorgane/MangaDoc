<?php
// src/DataFixtures/UserFixtures.php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        // $product = new Product();
        // $manager->persist($product);

        $user->setMail('admin.mail@test.test')
             ->setPassword($this->passwordEncoder->encodePassword($user, 'admin'));

        $manager->persist($user);

        $manager->flush();
    }
}

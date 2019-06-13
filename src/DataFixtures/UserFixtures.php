<?php
// src/DataFixtures/UserFixtures.php

namespace App\DataFixtures;

use App\Entity\User;

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

    public function load(ObjectManager $em)
    {
        for ($i = 0; $i < 2; $i++) {
            $user = new User();
            if ($i == 1) {
                $user->setPassword($this->passwordEncoder->encodePassword($user, 'admin'))
                    ->setEmail('admin@test.test')
                    ->setRoles(['ROLE_ADMIN']);
            } else {
                $user->setPassword($this->passwordEncoder->encodePassword($user, 'user'))
                    ->setEmail('user@test.test')
                    ->setRoles(['ROLE_USER']);
            }
            $em->persist($user);
        }
        $em->flush();
    }
}

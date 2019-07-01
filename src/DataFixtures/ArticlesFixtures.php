<?php
// src/DataFixtures/ArticlesFixtures.php

namespace App\DataFixtures;

use App\Entity\Article;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticlesFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @var UserRepository
     */
    private $repository = null;

    public function load(ObjectManager $em)
    {
        $faker = Faker\Factory::create('fr_FR');

        $user_repository = $em->getRepository(User::class);

        for ($i = 0; $i < 30; $i++) {
            $article = new Article();
            $article
                ->setTitle($faker->name)
                ->setAuthor($faker->name)
                ->setEditor($faker->name)
                ->setState($faker->word)
                ->setDescription($faker->text)
                ->setDateAdded($faker->dateTime)
                ->setIntegral($faker->boolean)
                ->setPrice($faker->numberBetween(3, 100))
                ->setGenre($faker->word)
                ->setIdUser($user_repository->findRandom());
            $em->persist($article);
        }
        $em->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
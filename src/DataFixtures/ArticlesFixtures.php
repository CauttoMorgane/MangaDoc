<?php
// src/DataFixtures/ArticlesFixtures.php

namespace App\DataFixtures;

use App\Entity\Article;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ArticlesFixtures extends Fixture
{

    public function load(ObjectManager $em)
    {
        $faker = Faker\Factory::create('fr_FR');
        $userAdmin = $this->getReference('2');

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
                ->setIdUser($userAdmin);;
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
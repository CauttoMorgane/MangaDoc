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

        for ($i = 0; $i < 30; $i++){
            $article = new Article();
            $article->setTitle($faker->title)
                    ->setDescription($faker->text);
            $em->persist($article);
        }
        $em->flush();
    }

}
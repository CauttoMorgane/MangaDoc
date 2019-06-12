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
        // initialisation de l'objet Faker
        // on peut préciser en paramètre la localisation,
        // pour avoir des données qui semblent "françaises"
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++){
            $article = new Article();
            $article->setTitle($faker->title)
                    ->setDescription($faker->text);
            $em->persist($article);
        }
        $em->flush();
    }

}
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
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Filesystem\Filesystem;

class ArticlesFixtures extends Fixture implements DependentFixtureInterface
{

    private static $BASE_URL = "https://cdn.mangaeden.com/mangasimg/";

    private $webDirectory;

    public function __construct($webDirectory)
    {
        $this->webDirectory = $webDirectory;
    }

    /**
     * @var UserRepository
     */
    private $repository = null;

    public function load(ObjectManager $em)
    {
        $faker = Faker\Factory::create('fr_FR');
        $user_repository = $em->getRepository(User::class);

        // download the json stubs file and parse it
        $data = json_decode(file_get_contents('https://www.mangaeden.com/api/list/0/?p=0'));

        // foreach entry in the manga array
        foreach($data->manga as $manga) {
            // skip if there is no image
            if(empty($manga->im)) {
                continue;
            }

            // get the distant url
            $dist_url = self::$BASE_URL . $manga->im;
            // set the local url
            $local_url = '/images/' . $manga->im;

            // if the directory doesn't exists, create if
            if(!file_exists(dirname($this->webDirectory . $local_url))) {
                mkdir(dirname($this->webDirectory . $local_url), 0777, true);
            }

            // if the image doesn't exists, create if
            if(!file_exists($this->webDirectory . $local_url)) {
                file_put_contents($this->webDirectory . $local_url, file_get_contents($dist_url));
            }

            // Create the article
            $article = new Article();
            $article
                ->setTitle($manga->t)
                ->setImageUrl($local_url)
                ->setAuthor($faker->name)
                ->setEditor($faker->name)
                ->setState($manga->s)
                ->setDescription(
                    implode(' ', [
                        $manga->a, implode('-', $manga->c), $manga->i
                    ]) . "\n" . $faker->text
                )
                ->setDateAdded($faker->dateTime)
                ->setIntegral($faker->boolean)
                ->setPrice($faker->numberBetween(3, 100))
                ->setGenre($faker->word)
                ->setIdUser($user_repository->findRandom());
            // Save the article
            $em->persist($article);
        }
        $em->flush();

//        for ($i = 0; $i < 30; $i++) {
//            $article = new Article();
//            $article
//                ->setTitle($faker->name)
//                ->setAuthor($faker->name)
//                ->setEditor($faker->name)
//                ->setState($faker->word)
//                ->setDescription($faker->text)
//                ->setDateAdded($faker->dateTime)
//                ->setIntegral($faker->boolean)
//                ->setPrice($faker->numberBetween(3, 100))
//                ->setGenre($faker->word)
//                ->setIdUser($user_repository->findRandom());
//            $em->persist($article);
//        }
//        $em->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
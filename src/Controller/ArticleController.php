<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article.index")
     */
    public function index(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();
        return $this->render("article.index.html.twig", [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/article/{id}", name="article.show")
     */
    public function show(ArticleRepository $articleRepository, int $id)
    {
        $article = $articleRepository->find($id);
        $articles = $articleRepository->findAll();
        return $this->render("article.show.html.twig", [
            'article' => $article,
            'articles' => $articles
        ]);
    }
}

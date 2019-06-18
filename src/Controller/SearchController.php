<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index()
    {
        return $this->render('search/search.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    public function searchBar()
    {
      $form = $this->createFormBuilder(null)

      ->add('Search', TextType::class)
      ->add('search', SubmitType::class,[
        'attr' => [
          'class' => 'btn btn-primary'
        ]
      ])
      ->getForm();

    return $this->render('search/search.html.twig', [
      'form' => $form->createView()
    ]);
    }
}

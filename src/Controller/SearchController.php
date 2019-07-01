<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use src\DataFixtures\ArticleFixtures;
use src\Entity\Article;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

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
                   ->setAction($this->generateUrl('handle_search'))
                   ->add("search", TextType::class, [
                       'attr' => [
                           'placeholder'   => 'Rechercher un article'
                       ]
                   ])
                   // ->add("entrer", SubmitType::class)
               ->getForm();
           return $this->render('search/search.html.twig', [
               'form' => $form->createView()
           ]);
       }
       /**
        * @Route("/handleSearch/{_query?}", name="handle_search", methods={"POST", "GET"})
        */
       public function handleSearchRequest(Request $request, $_query)
       {
           $em = $this->getDoctrine()->getManager();
           if ($_query)
           {
               $data = $em->getRepository(Article::class)->findByFirstName($_query);
           } else {
               $data = $em->getRepository(Article::class)->findAll();
           }

           // setting up the serializer
           $normalizers = [
               new ObjectNormalizer()
           ];
           $encoders =  [
               new JsonEncoder()
           ];
           $serializer = new Serializer($normalizers, $encoders);
           $data = $serializer->serialize($data, 'json');
           return new JsonResponse($data, 200, [], true);
       }



}

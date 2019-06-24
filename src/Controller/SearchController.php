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
      //formulaire récupérant la valeur de l'input
      $form = $this->createFormBuilder(null)

      ->add('Search', TextType::class)
      // ->add('search', SubmitType::class,[
      //   'attr' => [
      //     'class' => 'btn btn-primary'
      //   ]
      // ])
      ->getForm();

    return $this->render('search/search.html.twig', [
      'form' => $form->createView()
    ]);

    //Fonction permettant la recherche dans la bdd

    $output = '';
    if(isset($_POST['search'])){
      $searchq = $POST['search'];
      $searchq = preg_replace("#[^0-9a-z]#i","", $searchq);

      $query = mysql_query(" SELECT * FROM mangaDoc WHERE user LIKE '%searchq%' OR article LIKE '%searchq%' ") or die("could not find");
      $count = mysql_num_rows($query);
      if($count == 0){
        $output = 'There was no search result';
      }
      else{
        while($row = mysql_fetch_array($query)){
          $user = $row['user'];
          $article = $row['article'];
          $id = $row['id'];

          $output .= '<div>'.$user.''.$article.'<div>';
        }
      }
    }
    }


}

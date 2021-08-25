<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/article/add", name="app_article_add")
     */
    public function index(): Response
    {
        $article = new Article();
        $article->setTitle("Cours Python")
                ->setContent("PythonPythonPythonPython ....");
        
        // utiliser doctrine
        $em = $this->getDoctrine()->getManager();

        $em->persist($article);
        $em->flush();
  
        dd("Ajouter un artcile");
    }


    /**
     * @Route("/article/{title}", name="app_article_list")
     */
    public function afficher(ArticleRepository $repo,$title): Response
    {

        $articles = $repo->findOneByTitle($title);
        dd($articles);
    }

  
}

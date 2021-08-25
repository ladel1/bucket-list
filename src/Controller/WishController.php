<?php

namespace App\Controller;

use App\Entity\Wish;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wish", name="app_wish")
 */
class WishController extends AbstractController
{

    /**
     * @Route("/add", name="_add")
     */
    public function add(): Response
    {
        $em=$this->getDoctrine()->getManager();
        $wish = new Wish();
        $wish->setTitle("2321321")
             ->setDescription("32132132")
             ->setIsPublished(true)
             ->setAuthor("Sarah")
             ->setDateCreated(new \DateTime("now"));
        $em->persist($wish);
        $em->flush();
        dd($wish);
        
    }

    /**
     * @Route("/list", name="_list")
     */
    public function index(): Response
    {
        $repo=$this->getDoctrine()->getRepository(Wish::class);
        $wishes=$repo->findBy(['isPublished'=>true],["dateCreated"=>"DESC"]);        
        return $this->render('wish/index.html.twig',compact('wishes'));
    }

    /**
     * @Route("/detail/{id}", name="_detail")
     */
    public function detail($id): Response
    {
        $repo=$this->getDoctrine()->getRepository(Wish::class);
        $wish = $repo->find($id);
        return $this->render('wish/detail.html.twig',compact('wish'));
    }    
}

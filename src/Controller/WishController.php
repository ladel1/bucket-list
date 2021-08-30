<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function add(Request $request,EntityManagerInterface $em): Response
    {
        $wish = new Wish();
        $form = $this->createForm(WishType::class,$wish);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $wish->setDateCreated(new \DateTime("now"));
            $wish->setIsPublished(true);
            $em->persist($wish);
            $em->flush();
            $this->addFlash("message","Idea successfully added!");

            return $this->redirectToRoute("app_wish_detail",['id'=>$wish->getId()]);
        }
        return $this->render('wish/ajouter.html.twig',["form"=>$form->createView()]);
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

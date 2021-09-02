<?php

namespace App\Controller;

use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function home(MailerService $mailer): Response
    {
        $mailer->send(  "adel@codingx.tech",
                        "adel.latibi@gmail.com",
                        "Formation gratuite de Java Se",
                        "email/index.html.twig",
                        [
                            "title"=>"JAVA POO"
                        ]
                    );
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/about-us", name="app_about_us")
     */
    public function aboutUs(): Response
    {
        return $this->render('main/about-us.html.twig');
    }



}

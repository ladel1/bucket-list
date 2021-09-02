<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailerService{

    private $mailer;
    private $twig;
    function __construct(MailerInterface $mailer,Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    function send($from,$to,$subject,$template,$params=[]){
        // init mail 
        $email = new Email();
        $email->from($from);
        $email->to($to);
        $email->subject($subject);
    

        $email->html($this->twig->render($template,$params));
        // l'envoi de mail
        $this->mailer->send($email);
    }
}
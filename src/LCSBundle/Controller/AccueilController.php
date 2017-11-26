<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Accueil:index.html.twig');
    }

    public function loginAction() {
        
    }
}

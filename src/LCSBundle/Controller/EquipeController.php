<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EquipeController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Equipe:index.html.twig');
    }
}

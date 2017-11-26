<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompetitionController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Competition:index.html.twig');
    }
}

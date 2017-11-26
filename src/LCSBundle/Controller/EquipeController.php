<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class EquipeController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Equipe:index.html.twig');
    }

    public function detailsAction($nom)
    {
    	$equipe = $this->getDoctrine()->getRepository("LCSBundle:Equipe")->findOneByNom($nom);
    	
        return $this->render('LCSBundle:Equipe:details.html.twig', array(
        	'equipe' => $equipe
        ));
    }

    public function listeAction()
    {
        $equipes = $this->getDoctrine()->getRepository("LCSBundle:Equipe")->findAll();
        $data     = ['data' => []];
        foreach($equipes as $equipe) {
            $data['data'][] = [
                'nom'        => $equipe ? $equipe->getNom() : null,
                'slogan'     => $equipe ? $equipe->getSlogan() : null,
                //Permet de récupérer l'id pour chaque td du tableau
                //Pour pouvoir gérer le click qur la ligne en js, et rediriger vers la bonne affaire
                'DT_RowId'   => 'id_'.$equipe->getNom()
            ];
        }
        return (new JsonResponse)->setData($data);
    }
}

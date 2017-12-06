<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class JoueurController extends Controller
{
    public function indexAction()
    {
        $rangs = $this->getDoctrine()->getRepository("LCSBundle:Rang")->findAll();
        $style = "";
        foreach ($rangs as $rang) {
            $style.="
                .".$rang->getNom()." {
                    width: 100%;
                    display: inline-block;
                    text-align: center;
                    background-color: ".$rang->getCouleur().";
                }
                ";
        }
        return $this->render('LCSBundle:Joueur:index.html.twig', array(
            "style" => $style
        ));
    }

    public function detailsAction($id)
    {
    	$joueur = $id ? $this->getDoctrine()->getRepository("LCSBundle:Joueur")->find($id) : null;
    	
        return $this->render('LCSBundle:Joueur:details.html.twig', array(
        	'joueur' => $joueur
        ));
    }

    public function listeAction()
    {        
        $joueurs = $this->getDoctrine()->getRepository("LCSBundle:Joueur")->findAll();
        $data     = ['data' => []];
        foreach($joueurs as $joueur) {
            $color = $joueur ? $joueur->getRang()->getNom() : null;
            $rang = "<span class=\"$color\">".($joueur ? $joueur->getRang()->getNom() : null)."</span>";
            $data['data'][] = [
                'pseudo'     => $joueur ? $joueur->getPseudo() : null,
                'prenom'     => $joueur ? ucwords($joueur->getPrenom()) : null,
                'nom'        => $joueur ? ucwords($joueur->getNom()) : null,
                'poste'      => $joueur ? $joueur->getPoste()->getNom() : null,
                'rang'       => $rang,
                //Permet de récupérer l'id pour chaque td du tableau
                //Pour pouvoir gérer le click qur la ligne en js, et rediriger vers la bonne affaire
                'DT_RowId'   => 'id_'.$joueur->getId()
            ];
        }
        return (new JsonResponse)->setData($data);
    }
}

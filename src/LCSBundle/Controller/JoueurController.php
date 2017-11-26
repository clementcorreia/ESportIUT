<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class JoueurController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Joueur:index.html.twig');
    }

    public function detailsAction($pseudo)
    {
    	$joueur = $this->getDoctrine()->getRepository("LCSBundle:Joueur")->findOneBy(array('pseudo' => $pseudo));
    	$joueur_empty = array();
		$joueur_empty['pseudo'] = null;
		$joueur_empty['prenom'] = null;
		$joueur_empty['nom'] = null;
		$joueur_empty['poste'] = null;
		$joueur_empty['description'] = null;
    	
        return $this->render('LCSBundle:Joueur:details.html.twig', array(
        	'joueur' => $joueur //? $joueur : $joueur_empty
        ));
    }

    public function listeAction()
    {
        $joueurs = $this->getDoctrine()->getRepository("LCSBundle:Joueur")->findAll();
        $data     = ['data' => []];
        foreach($joueurs as $joueur) {
            $data['data'][] = [
                'pseudo'     => $joueur ? $joueur->getPseudo() : null,
                'prenom'     => $joueur ? $joueur->getPrenom() : null,
                'nom'        => $joueur ? $joueur->getNom() : null,
                'poste'      => $joueur ? $joueur->getPoste()->getNom() : null,
                //Permet de récupérer l'id pour chaque td du tableau
                //Pour pouvoir gérer le click qur la ligne en js, et rediriger vers la bonne affaire
                'DT_RowId'   => 'id_'.$joueur->getPseudo()
            ];
        }
        return (new JsonResponse)->setData($data);
    }
}

<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CompetitionController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Competition:index.html.twig');
    }

    public function detailsAction($nom)
    {
    	$competition = $this->getDoctrine()->getRepository("LCSBundle:Competition")->findOneByNom($nom);

    	if($competition) {
			$competition->setDateDebut($competition->getDateDebut()->format('d/m/Y'));
    		$competition->setDateFin($competition->getDateFin()->format('d/m/Y'));
    	}
    	
        return $this->render('LCSBundle:Competition:details.html.twig', array(
        	'competition' => $competition
        ));
    }

    public function listeAction()
    {
        $competitions = $this->getDoctrine()->getRepository("LCSBundle:Competition")->findAll();
        $data     = ['data' => []];
        foreach($competitions as $competition) {
        	$equipesInscrites = $competition ? count($competition->getEquipes()).'/'.$competition->getNbEquipeMax() : null;
            $data['data'][] = [
                'nom'       => $competition ? $competition->getNom() : null,
                'dateDebut' => $competition ? $competition->getDateDebut()->format('d/m/Y') : null,
                'dateFin'   => $competition ? $competition->getDateFin()->format('d/m/Y') : null,
                'equipes'	=> $equipesInscrites,
                //Permet de récupérer l'id pour chaque td du tableau
                //Pour pouvoir gérer le click qur la ligne en js, et rediriger vers la bonne affaire
                'DT_RowId'  => 'id_'.$competition->getNom()
            ];
        }
        return (new JsonResponse)->setData($data);
    }
}

<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use LCSBundle\Entity\Competition;
use LCSBundle\Form\CompetitionType;
use LCSBundle\Form\TourType;

class CompetitionController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Competition:index.html.twig');
    }

    public function detailsAction($id)
    {

        // Onglet Détails

    	$competition = $this->getDoctrine()->getRepository("LCSBundle:Competition")->find($id);
        $equipesInscrites = $competition ? count($competition->getEquipes()).'/'.$competition->getNbEquipeMax() : null;

    	/*if($competition) {
			$competition->setDateDebut($competition->getDateDebut()->format('d/m/Y'));
    		if($competition->getDateFin())
                $competition->setDateFin($competition->getDateFin()->format('d/m/Y'));
    	}*/

        // Onglet Poules

        $poules = $competition ? $this->getDoctrine()->getRepository("LCSBundle:Poule")->findPoulesCompetition($competition->getId()) : null;

        $equipesPoules = array();
        $matchsPoules = array();
        $matchs = array();
        foreach ($poules as $key => $poule) {
            $equipesPoules[$key] = $poule->getEquipes()->getValues();
            $matchsPoules[$key] = $this->getDoctrine()->getRepository("LCSBundle:Game")->findGamesByPoule($poule->getId());
            usort($equipesPoules[$key], function($a, $b)
            {
                return strcmp($a->getNom(), $b->getNom());
            });
        }

        // Onglet Matchs

        $tours = $competition ? $this->getDoctrine()->getRepository("LCSBundle:Tour")->findByCompetition($competition) : null;
        


        /*$equipes = array();
        foreach ($equipesPoules as $key => $equipe) {
            $equipes[$key] = $equipe->getValues();
        }*/

        return $this->render('LCSBundle:Competition:details.html.twig', array(
            'competition' => $competition,
            'poules' => $poules,
            'tours' => $tours,
            'equipes' => $equipesPoules,
            'matchs' => $matchsPoules,
            'equipesInscrites' => $equipesInscrites
        ));
    }
    
    public function editTourAction(Request $request, $id) {
        
        $competition = $id ? $this->getDoctrine()->getRepository("LCSBundle:Competition")->find($id) : null;
        
        $form = $this->createFormBuilder()//$defaultData)
        	->setAction($this->generateUrl('lcs_competitions_editTour', array('id' => $id)));
                
        $tours = $this->getDoctrine()->getRepository("LCSBundle:Tour")->findByCompetition($competition);
        $form_id = array();
        foreach($tours as $tour) {
            // ajouter un champ dans le formulaire pour chaque tour
            $id = $tour->getId();
            $form_id[] = $id;
            $form->add("$id", TourType::class, array(
                'label' => $tour->getNom(),
                'data' => $tour,
            ));
        }

        $form = $form->getForm();

        $form->handleRequest($request);

        //Bien penser à tester si le formulaire est soumis
        if($form->isSubmitted()) {
        	if($form->isValid()) {
                        $em = $this->getDoctrine()->getManager();
                        foreach($tours as $tour) {
                            $id = $tour->getId();
                            $tourData = $form->get("$id")->getData();
                            $em->persist($tourData);
                        }
                        $em->flush();
	            //Dans la popup on ne redirige pas sur une url mais on retourne une réponse
	            //en json qui va afficher en toastr succees ce qui est marqué dans
	            //le div de l'id modal-validation-message-creation dans ta vue add ("Le Competition a été créé avec succès")
	            //traitement fait dans le fichier main.js
	            return new JsonResponse([
	                'res' => true,
	                'type' => 'editTour',
	                'closeModal' => true,
	                'id' => $id,
	                'confirmation_message_id' => 'modal-validation-message-creation-'.'editTour'
	            ]);
	        }
	        else{
	            //Erreur dans le formulaire, on affiche les erreurs
	            return new JsonResponse([
	                'res' => false,
	                'form_name' => $form->getName(),
	                'errors' => $this->getErrorsAsArray($form)
	            ]);
	        }
	    }
        return $this->render('LCSBundle:Competition:editTour.html.twig', array(
            'form' => $form->createView(),
            'form_id' => $form_id,
        ));        
    }

    public function listeAction()
    {
        $competitions = $this->getDoctrine()->getRepository("LCSBundle:Competition")->findAll();
        $data     = ['data' => []];
        foreach($competitions as $competition) {
            $url_det = $competition ? $this->generateUrl('lcs_competitions_details', array('id' => $competition->getId())) : null;
        	$equipesInscrites = $competition ? count($competition->getEquipes()).'/'.$competition->getNbEquipeMax() : null;
            $dates = $competition ? $competition->getDateFin() ? "Du ".$competition->getDateDebut()->format('d/m/Y')." au ".$competition->getDateFin()->format('d/m/Y') : "Depuis le ".$competition->getDateDebut()->format('d/m/Y') : null;
            $data['data'][] = [
                'nom'       => "<a href=\"$url_det\">".($competition ? $competition->getNom() : null)."</a>",
                'dates' => $dates,
                'equipes'	=> $equipesInscrites,
                'limiteInscriptions' => $competition ? $competition->getDateLimiteInscription() ? $competition->getDateLimiteInscription()->format('d/m/Y') : $competition->getDateDebut()->modify('-1 day')->format('d/m/Y') : null,
                //Permet de récupérer l'id pour chaque td du tableau
                //Pour pouvoir gérer le click qur la ligne en js, et rediriger vers la bonne affaire
                'DT_RowId'  => 'id_'.$competition->getId()
            ];
        }
        return (new JsonResponse)->setData($data);
    }

    /*
     * Un controller permettant d'ajouter ou de modifier une Competition
     * via une popup
     */
    public function editAction(Request $request, $id) {
        $competition = null;
        if(!is_null($id) && $id > 0)
            $competition = $this->getDoctrine()->getRepository("LCSBundle:Competition")->find($id);

        if (!$competition) {
            $competition = new Competition();
        }

        $form = $this->createForm(CompetitionType::class, $competition, array(
            'method' => 'POST',
            'action' => $this->generateUrl('lcs_competitions_edit', array('id' => $id))
        ));

        $form->handleRequest($request);

        //Bien penser à tester si le formulaire est soumis
        if($form->isSubmitted()){
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($competition);
                $em->flush();

                //Dans la popup on ne redirige pas sur une url mais on retourne une réponse
                //en json qui va afficher en toastr succees ce qui est marqué dans
                //le div de l'id modal-validation-message-creation dans ta vue add ("Le Competition a été créé avec succès")
                //traitement fait dans le fichier main.js
                return new JsonResponse([
                    'res' => true,
                    'type' => 'competition',
                    'id' => $competition->getId(),
                    'confirmation_message_id' => !$id ? 'modal-validation-message-creation' : 'modal-validation-message-modification'
                ]);
            }
            else{
                //Erreur dans le formulaire, on affiche les erreurs
                return new JsonResponse([
                    'res' => false,
                    'form_name' => $form->getName(),
                    'errors' => $this->getErrorsAsArray($form)
                ]);
            }
        }
        $nomCompet = $competition ? $competition->getNom() : null;
        return $this->render('LCSBundle:Competition:edit.html.twig', array(
            'competition' => $nomCompet,
            'form' => $form->createView()
        ));
    }

}

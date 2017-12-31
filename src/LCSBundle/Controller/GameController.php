<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use LCSBundle\Entity\Game;
use LCSBundle\Form\TourType;
use LCSBundle\Form\GameType;

class GameController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Game:index.html.twig');
    }

    public function generateGroupMatchesAction(Request $request, $id) {
    	$translator = $this->get('translator');

        /*$defaultData =  array(
            'method' => 'POST',
            'action' => $this->generateUrl('lcs_matchs_generateGroupMatches', array('id' => $id))
        );*/
        $form = $this->createFormBuilder()//$defaultData)
        	->setAction($this->generateUrl('lcs_matchs_generateGroupMatches', array('id' => $id)));
                
        $poules = $id ? $this->getDoctrine()->getRepository("LCSBundle:Poule")->findPoulesCompetition($id) : null;
        $equipesPoules = array();
        foreach ($poules as $key => $poule) {
            $equipesPoules[$key] = $poule->getEquipes()->getValues();
            usort($equipesPoules[$key], function($a, $b)
            {
                return strcmp($a->getNom(), $b->getNom());
            });
        }
        $max = 0;
        foreach ($equipesPoules as $key => $equipesPoule) {
            if(count($equipesPoule) >= $max) {
                $max = count($equipesPoule);
            }
        }
        $nbTours = $max - 1;
        $form_id = array();
        for($i = 1; $i <= $nbTours*2; $i++) {
            // ajouter un champ dans le formulaire pour chaque tour
            $form_id[] = array('num' => $i, 'cache' => $i <= $nbTours);
            $form->add("$i", TourType::class, array(
                'label' => "Tour $i",
            ));
        }

        $form = $form->add('matchReturn', ChoiceType::class, array(
                        'label' => $translator->trans('lcs.competition.game.labelReturn').' ?',
                        'choices' => array(
                            1 => $translator->trans('control.yes'),
                            0 => $translator->trans('control.no'),
                        ),
                        'data' => 0,
                        'multiple'  => false,
                        'expanded'  => true,
                        'attr' => array(
                            'onchange' => 'setDisplayToursMatchRetour();',
                        )
                    ))
                    ->getForm();

        $form->handleRequest($request);

        //Bien penser à tester si le formulaire est soumis
        if($form->isSubmitted()) {
        	if($form->isValid()) {
        		$matchReturn = $form->get('matchReturn')->getData();
                        $em = $this->getDoctrine()->getManager();
                        if($matchReturn==1) {
                            $nbTours*=2;
                        }
                        for($i=1; $i <= $nbTours; $i++) {
                            $tourData = $form->get("$i")->getData();
                            $id ? $tourData->setCompetition($this->getDoctrine()->getRepository("LCSBundle:Competition")->find($id)) : null;
                            $em->persist($tourData);
                        }
                        $em->flush();
        		$matchs = array();
        		foreach ($equipesPoules as $key => $equipesPoule) {
        		    $tab1 = $equipesPoule;
        		    $tab2 = $tab1;
        		    for($i = 0; $i < count($tab1); $i++) {
        		        for($j = $i+1; $j < count($tab2); $j++) {
        		            $equipeA = $equipesPoule[$i];
        		            $equipeB = $equipesPoule[$j];
        		            $matchs[$key][] = array(
        		                $equipeA,
        		                $equipeB,
                                        1,
        		            );
        		            if($matchReturn==1) { // si on veut des matchs retours
        		                $matchs[$key][] = array(
        		                    $equipeB,
        		                    $equipeA,
                                            1,
        		                );
        		            }
        		        }
        		    }
        		}
        		foreach ($poules as $key => $poule) {
                            foreach ($matchs[$key] as $match) {
                                $game = new Game();
                                $tour = $this->getDoctrine()->getRepository('LCSBundle:Tour')->find($match[2]);
                                $game->setPoule($poule)
                                    ->setNom($match[0]." VS ".$match[1])
                                    ->addEquipe($match[0])
                                    ->addEquipe($match[1])
                                    ->setTour($tour);
                                $em->persist($game);
                            }
        		}
                        $em->flush();
	            //Dans la popup on ne redirige pas sur une url mais on retourne une réponse
	            //en json qui va afficher en toastr succees ce qui est marqué dans
	            //le div de l'id modal-validation-message-creation dans ta vue add ("Le Competition a été créé avec succès")
	            //traitement fait dans le fichier main.js
	            return new JsonResponse([
	                'res' => true,
	                'type' => 'generateGM',
	                'closeModal' => true,
	                'id' => $id,
	                'confirmation_message_id' => 'modal-validation-message-creation-'.'generateGM'
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
        return $this->render('LCSBundle:Game:generateGroupMatches.html.twig', array(
            'form' => $form->createView(),
            'form_id' => $form_id,
            'nbTours' => $nbTours,
        ));
    }
    
    public function setTourFromMatchesAction(Request $request, $id) {
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
        
        $tours = $this->getDoctrine()->getRepository("LCSBundle:Tour")->findByCompetition($competition);
        $form_id = array();
        $form = $this->createFormBuilder()//$defaultData)
        	->setAction($this->generateUrl('lcs_matchs_setTourFromMatches', array('id' => $id)));
        foreach ($poules as $key => $poule) {
            foreach ($matchsPoules[$key] as $match) {
                $form->add($key."_".$match->getId(), new GameType(array('competition_id' => $id)), array(
                    'label' => '<span class="text-info">'.$match->getEquipeA().'</span> VS <span class="text-info">'.$match->getEquipeB().'</span>',
                    "data" => $match,
                ));
                $form_id[] = $key."_".$match->getId();
            }
        }
        

        // Onglet Matchs

        


        /*$equipes = array();
        foreach ($equipesPoules as $key => $equipe) {
            $equipes[$key] = $equipe->getValues();
        }*/

        return $this->render('LCSBundle:Game:setTourFromMatches.html.twig', array(
            'poules' => $poules,
            'tours' => $tours,
            'form' => $form->getForm()->createView(),
            'form_id' => $form_id,
        ));
    }

    /**
     * Récupère les erreurs du formulaire
     * @param type $form
     * @return type
     */
    public function getErrorsAsArray($form){
        $errors = [];
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $key => $child) {
            if ($this->getErrorsAsArray($child)) {
                $errors[$key] = $this->getErrorsAsArray($child);
            }
        }
        return $errors;
    }
}

<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use LCSBundle\Entity\Game;
use LCSBundle\Entity\Manche;
use LCSBundle\Entity\StatistiqueEquipe;
use LCSBundle\Entity\StatistiqueJoueur;
use LCSBundle\Form\TourType;
use LCSBundle\Form\StatistiqueEquipeType;
use LCSBundle\Form\StatistiqueJoueurType;
use LCSBundle\Form\GameType;

class GameController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Game:index.html.twig');
    }
    
    public function detailsAction($id)
    {
        $match = $id ? $this->getDoctrine()->getRepository("LCSBundle:Game")->find($id) : null;
        return $this->render('LCSBundle:Game:details.html.twig', array(
            'match' => $match,
            'manches' => $match->getManches()->getValues(),
        ));
    }

    public function addGameAction(Request $request, $id) {
        $manche = new Manche();
        
        $match = $id ? $this->getDoctrine()->getRepository("LCSBundle:Game")->find($id) : null;
        
        $statEquipeA = new StatistiqueEquipe();
        $statEquipeA->setEquipe($match->getEquipeA());
        
        $statEquipeB = new StatistiqueEquipe();
        $statEquipeB->setEquipe($match->getEquipeB());
        
        $form = $this->createFormBuilder()
                ->setAction($this->generateUrl('lcs_matchs_addGame', array('id' => $id)))
                ->add('resultat', ChoiceType::class, array(
                    'choices' => array(
                        0 => $match->getEquipeA(),
                        1 => $match->getEquipeB()
                    ),
                    'choices_as_values' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'label' => "Qui est le gagnant ?",
                ))
                ->add('duree', TimeType::class, array(
                    'with_seconds' => true,
                ))
                ->add('statEquipeA', StatistiqueEquipeType::class, array(
                    'data' => $statEquipeA,
                ))
                ->add('statEquipeB', StatistiqueEquipeType::class, array(
                    'data' => $statEquipeB,
                ))
                ->getForm();
        
        $form->handleRequest($request);

        //Bien penser à tester si le formulaire est soumis
        if($form->isSubmitted()){
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $manche->setGame($match);
                if($form->get("resultat")->getData() == 0) {
                   $manche->setWin($match->getEquipeA());
                   $manche->setLose($match->getEquipeB());
                }
                else {
                   $manche->setWin($match->getEquipeB());
                   $manche->setLose($match->getEquipeA());
                }
                $manche->setDuree($form->get("duree")->getData());
                $manche->addStatistiquesEquipe($form->get("statEquipeA")->getData()->setManche($manche));
                $manche->addStatistiquesEquipe($form->get("statEquipeB")->getData()->setManche($manche));
                $em->persist($manche);
                $em->flush();
                //Dans la popup on ne redirige pas sur une url mais on retourne une réponse
                //en json qui va afficher en toastr succees ce qui est marqué dans
                //le div de l'id modal-validation-message-creation dans ta vue add ("Le Competition a été créé avec succès")
                //traitement fait dans le fichier main.js
                return new JsonResponse([
                    'res' => true,
                    'type' => 'addGame',
                    'closeModal' => true,
                    'id' => $id,
                    'confirmation_message_id' => 'modal-validation-message-creation-' . 'addGame'
                ]);
            } else {
                //Erreur dans le formulaire, on affiche les erreurs
                return new JsonResponse([
                    'res' => false,
                    'form_name' => $form->getName(),
                    'errors' => $this->getErrorsAsArray($form)
                ]);
            }
        }
        
        return $this->render('LCSBundle:Game:addGame.html.twig', array(
            'form' => $form->createView(),
            'equipeA' => $match->getEquipeA(),
            'equipeB' => $match->getEquipeB(),
        ));
    }
    
    public function addStatJoueurAction(Request $request, $id = 0) {
        if($id) {
            $statJoueur = new StatistiqueJoueur();
            $manche = $id ? $this->getDoctrine()->getRepository("LCSBundle:Manche")->find($id) : null;
            if($manche) $statJoueur->setManche($manche);

            $game = $manche ? $manche->getGame() : null;
            $joueursEquipeA = $game ? $game->getEquipeA() ? $game->getEquipeA()->getJoueurs()->getValues() : array() : array();
            $joueursEquipeA[] = $game ? $game->getEquipeA() ? $game->getEquipeA()->getCapitaine() : array() : array();
            $joueursEquipeB = $game ? $game->getEquipeB() ? $game->getEquipeB()->getJoueurs()->getValues() : array() : array();
            $joueursEquipeB[] = $game ? $game->getEquipeB() ? $game->getEquipeB()->getCapitaine() : array() : array();
            $joueurs = $game ? array_merge($joueursEquipeA, $joueursEquipeB) : array();
            $statsJoueurs = $manche ? $manche->getStatistiquesJoueurs()->getValues() : array();
            foreach($statsJoueurs as $stat) {
                $index = array_search($stat->getJoueur(), $joueurs);
                if($index >= 0) {
                    unset($joueurs[$index]);
                }
            }

            $form = $this->createForm(StatistiqueJoueurType::class, $statJoueur, array(
                'method' => 'POST',
                'action' => $this->generateUrl('lcs_matchs_addStatJoueur', array('id' => $id)),
                'joueurs' => $joueurs,
            ));

            $form->handleRequest($request);

            if($form->isSubmitted()) {
                if($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($statJoueur);
                    $em->flush();
                }
            }
            return $this->render('LCSBundle:Game:statJoueur.html.twig', array(
                'form' => $form->createView(),
            ));
        }
        return $this->render('LCSBundle:Game:statJoueur.html.twig', array(
            'form' => null,
        ));
    }
    
    public function generateGroupMatchesAction(Request $request, $id) {
    	$translator = $this->get('translator');

        /*$defaultData =  array(
            'method' => 'POST',
            'action' => $this->generateUrl('lcs_matchs_generateGroupMatches', array('id' => $id))
        );*/
        
        $competition = $id ? $this->getDoctrine()->getRepository("LCSBundle:Competition")->find($id) : null;
        
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
                                $game->setPoule($poule)
                                    ->setNom($match[0]." VS ".$match[1])
                                    ->setEquipeA($match[0])
                                    ->setEquipeB($match[1]);
                                $em->persist($game);
                            }
        		}
                        if ($competition) {
                            $competition->setIsGroupMatchesGenerated(true);
                            $em->persist($competition);
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
    
    public function deleteGroupMatchesAction(Request $request, $id) {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('lcs_matchs_deleteGroupMatches', array('id' => $id)))
            ->getForm();

        $form->handleRequest($request);

        //Bien penser à tester si le formulaire est soumis
        if($form->isSubmitted()){
            if($form->isValid()) {
                $competition = $id ? $this->getDoctrine()->getRepository('LCSBundle:Competition')->find($id) : null;
                if(is_null($competition)) {
                    return new JsonResponse([
                        'res' => false,
                        'confirmation_message_id' => 'modal-deleteGM-message-error'
                    ]);
                }
                $em = $this->getDoctrine()->getManager();
                $poules = $competition ? $this->getDoctrine()->getRepository("LCSBundle:Poule")->findByCompetition($competition) : null;
                $matchs = array();
                foreach ($poules as $poule) {
                    $matchs_tmp = $this->getDoctrine()->getRepository("LCSBundle:Game")->findByPoule($poule);
                    foreach ($matchs_tmp as $match) {
                        $matchs[] = $match;
                    }                    
                }
                foreach ($matchs as $match) {
                    $em->remove($match);
                }
                $tours = $competition ? $this->getDoctrine()->getRepository("LCSBundle:Tour")->findByCompetition($competition) : null;
                foreach($tours as $tour) {
                    $em->remove($tour);
                }
                $competition->setIsGroupMatchesGenerated(false);
                $em->persist($competition);
                $em->flush();
                return new JsonResponse([
                    'res' => true,
                    'confirmation_message_id' => 'modal-deleteGM-message-ok'
                ]);
            }
        }
        return $this->render('LCSBundle:Game:deleteGroupMatches.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function setTourFromMatchesAction(Request $request, $id) {
        
    	$competition = $this->getDoctrine()->getRepository("LCSBundle:Competition")->find($id);
        $equipesInscrites = $competition ? count($competition->getEquipes()).'/'.$competition->getNbEquipeMax() : null;

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
                $form->add($match->getId(), new GameType(array('competition_id' => $id)), array(
                    'label' => '<span class="text-info">'.$match->getEquipeA().'</span> VS <span class="text-info">'.$match->getEquipeB().'</span>',
                    "data" => $match,
                ));
                $form_id[] = $match->getId();
            }
        }

        $form = $form->getForm();

        $form->handleRequest($request);

        //Bien penser à tester si le formulaire est soumis
        if($form->isSubmitted()) {
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                foreach ($poules as $key => $poule) {
                    foreach ($matchsPoules[$key] as $match) {
                        $id = $match->getId();
                        $tour = $form->get("$id")->getData();
                        //$match = $id ? $this->getDoctrine()->getRepository("LCSBundle:Match")->find($id) : null;
                        //$match ? $match->setTour($tour) : null;
                        $em->persist($tour);
                    }
                }
                $em->flush();
                //Dans la popup on ne redirige pas sur une url mais on retourne une réponse
                //en json qui va afficher en toastr succees ce qui est marqué dans
                //le div de l'id modal-validation-message-creation dans ta vue add ("Le Competition a été créé avec succès")
                //traitement fait dans le fichier main.js
                return new JsonResponse([
                    'res' => true,
                    'type' => 'setTourGM',
                    'closeModal' => true,
                    'id' => $id,
                    'confirmation_message_id' => 'modal-validation-message-creation-'.'setTourGM'
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
        
        return $this->render('LCSBundle:Game:setTourFromMatches.html.twig', array(
            'poules' => $poules,
            'tours' => $tours,
            'form' => $form->createView(),
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

<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use LCSBundle\Entity\Game;

class GameController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Game:index.html.twig');
    }

    public function generateGroupMathesAction(Request $request, $id) {
    	$translator = $this->get('translator');

        /*$defaultData =  array(
            'method' => 'POST',
            'action' => $this->generateUrl('lcs_matchs_generateGroupMathes', array('id' => $id))
        );*/

        $form = $this->createFormBuilder()//$defaultData)
        	->setAction($this->generateUrl('lcs_matchs_generateGroupMathes', array('id' => $id)))
            ->add('matchReturn', ChoiceType::class, array(
                'label' => $translator->trans('lcs.competition.game.labelReturn').' ?',
                'choices' => array(
                    1 => $translator->trans('control.yes'),
                    0 => $translator->trans('control.no'),
                ),
                'multiple'  => false,
                'expanded'  => true
            ))
            ->getForm();

        $form->handleRequest($request);

        //Bien penser à tester si le formulaire est soumis
        if($form->isSubmitted()) {
        	if($form->isValid()) {
        		$matchReturn = $form->get('matchReturn')->getData();
        		$poules = $id ? $this->getDoctrine()->getRepository("LCSBundle:Poule")->findPoulesCompetition($id) : null;
        		$equipesPoules = array();
        		foreach ($poules as $key => $poule) {
        		    $equipesPoules[$key] = $poule->getEquipes()->getValues();
        		    usort($equipesPoules[$key], function($a, $b)
        		    {
        		        return strcmp($a->getNom(), $b->getNom());
        		    });
        		}
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
        		                $equipeB
        		            );
        		            if($matchReturn==1) { // si on veut des matchs retours
        		                $matchs[$key][] = array(
        		                    $equipeB,
        		                    $equipeA
        		                );
        		            }
        		        }
        		    }
        		}
				$em = $this->getDoctrine()->getManager();
        		foreach ($poules as $key => $poule) {
        			foreach ($matchs[$key] as $match) {
        				$game = new Game();
        				$game->setPoule($poule)
        						->addEquipe($match[0])
        						->addEquipe($match[1]);
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
	                'type' => 'game',
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
            'form' => $form->createView()
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

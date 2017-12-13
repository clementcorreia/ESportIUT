<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use LCSBundle\Entity\Poule;
use LCSBundle\Form\PouleType;

class PouleController extends Controller
{
    /*
     * Un controller permettant d'ajouter ou de modifier une poule
     * via une popup
     */
    public function editAction(Request $request, $id, $idCompetition) {
        $poule = null;
        if(!is_null($id) && $id > 0) {
            $poule = $this->getDoctrine()->getRepository('LCSBundle:Poule')->find($id);
            dump($poule->getNom());   
        }

        if (!$poule) {            
        	$poule = new Poule();
        	$poule->setCompetition($this->getDoctrine()->getRepository('LCSBundle:Competition')->find($idCompetition));
        	$poule->setType(0);
            dump("l");
        }

        $form = $this->createForm(PouleType::class, $poule, array(
            'method' => 'POST',
            'action' => $this->generateUrl('lcs_poules_edit', array('idCompetition' => $idCompetition, 'id' => $id))
        ));

        $form->handleRequest($request);

        //Bien penser à tester si le formulaire est soumis
        if($form->isSubmitted()){
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($poule);
                $em->flush();

                //Dans la popup on ne redirige pas sur une url mais on retourne une réponse
                //en json qui va afficher en toastr succees ce qui est marqué dans
                //le div de l'id modal-validation-message-creation dans ta vue add ("Le poule a été créé avec succès")
                //traitement fait dans le fichier main.js
                return new JsonResponse([
                    'res' => true,
                    'type' => 'poule',
                    'id' => $poule->getId(),
                    'closeModal' => true,
                    'confirmation_message_id' => !$idCompetition ? 'modal-validation-message-creation' : 'modal-validation-message-modification'
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
        $nomCompet = $poule ? $poule->getCompetition()->getNom() : null;
        return $this->render('LCSBundle:Poule:edit.html.twig', array(
            'competition' => $nomCompet,
            'form' => $form->createView(),
        ));
    }
}

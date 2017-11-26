<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use LCSBundle\Entity\Competition;
use LCSBundle\Form\CompetitionType;

class CompetitionController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Competition:index.html.twig');
    }

    public function detailsAction($id)
    {
    	$competition = $this->getDoctrine()->getRepository("LCSBundle:Competition")->find($id);

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
                'DT_RowId'  => 'id_'.$competition->getId()
            ];
        }
        return (new JsonResponse)->setData($data);
    }

    /*
     * Un controller permettant d'ajouter ou de modifier une Competition
     * via une popup
     */
    public function editAction(Request $request, $id = null) {
        $competition = null;
        if(!is_null($id) && $id > 0)
            $competition = $this->getDoctrine()->getRepository("LCSBundle:Competition")->find($id);

        if (!$competition) {
            $competition = new Competition();
        }

        $form = $this->createForm(CompetitionType::class, $competition,array(
            'method' => 'POST',
            'action' => $this->generateUrl('lcs_competitions_edit', array('id' => $id)),
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

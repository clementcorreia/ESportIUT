<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use LCSBundle\Entity\Equipe;
use LCSBundle\Form\EquipeType;

class EquipeController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:Equipe:index.html.twig');
    }

    public function detailsAction($id)
    {
    	$equipe = $this->getDoctrine()->getRepository("LCSBundle:Equipe")->find($id);
    	
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
                'capitaine'  => $equipe ? $equipe->getCapitaine()->__toString() : null,
                'nbJoueurs'  => $equipe ? count($equipe->getJoueurs()) + ($equipe->getCapitaine() ? 1 : 0) : null,
                //Permet de récupérer l'id pour chaque td du tableau
                //Pour pouvoir gérer le click qur la ligne en js, et rediriger vers la bonne affaire
                'DT_RowId'   => 'id_'.$equipe->getId()
            ];
        }
        return (new JsonResponse)->setData($data);
    }

    /*
     * Un controller permettant d'ajouter ou de modifier une Competition
     * via une popup
     */
    public function editAction(Request $request, $id = null) {
        $equipe = null;
        if(!is_null($id) && $id > 0)
            $equipe = $this->getDoctrine()->getRepository("LCSBundle:Equipe")->find($id);

        if (!$equipe) {
            $equipe = new Equipe();
        }

        $form = $this->createForm(EquipeType::class, $equipe,array(
            'method' => 'POST',
            'action' => $this->generateUrl('lcs_equipes_edit', array('id' => $id)),
        ));

        $form->handleRequest($request);

        //Bien penser à tester si le formulaire est soumis
        if($form->isSubmitted()){
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($equipe);
                $em->flush();

                //Dans la popup on ne redirige pas sur une url mais on retourne une réponse
                //en json qui va afficher en toastr succees ce qui est marqué dans
                //le div de l'id modal-validation-message-creation dans ta vue add ("Le Competition a été créé avec succès")
                //traitement fait dans le fichier main.js
                return new JsonResponse([
                    'res' => true,
                    'type' => 'equipe',
                    'id' => $equipe->getId(),
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
        $nomEquipe = $equipe ? $equipe->getNom() : null;
        return $this->render('LCSBundle:Equipe:edit.html.twig', array(
            'equipe' => $nomEquipe,
            'form' => $form->createView()
        ));
    }
}

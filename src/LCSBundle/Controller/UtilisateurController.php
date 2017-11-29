<?php

namespace LCSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\Type\RegistrationFormType;

class UtilisateurController extends Controller
{
    public function indexAction()
    {
        return $this->render('LCSBundle:User:index.html.twig');
    }

    public function profilAction($username) {
        $rangs = $this->getDoctrine()->getRepository("LCSBundle:Rang")->findAll();
        $style = "";
        foreach ($rangs as $rang) {
            $style.="
                .".$rang->getNom()." {
                    width: 200px;
                    display: inline-block;
                    text-align: center;
                    background-color: ".$rang->getCouleur().";
                }
                ";
        }
        $user = $this->getDoctrine()->getRepository("UserBundle:User")->findOneByUsername($username);
        return $this->render('LCSBundle:User:profil.html.twig', array(
            'user' => $user,
            'style' => $style
        ));
    }

    public function listeAction()
    {
        $users = $this->getDoctrine()->getRepository("UserBundle:User")->findAll();
        $data     = ['data' => []];
        foreach($users as $user) {
            $actions = '<a href=""><span class="glyphicon glyphicon-cog text-warning"></span></a><a href=""><span class="glyphicon glyphicon-trash text-danger"></span></a>';
            $data['data'][] = [
                'username'  => $user ? $user->getUsername() : null,
                'mail'      => $user ? $user->getEmail() : null,
                'roles'     => $user ? $user->getRoles() : null,
                'actions'   => $actions,
                //Permet de récupérer l'id pour chaque td du tableau
                //Pour pouvoir gérer le click qur la ligne en js, et rediriger vers la bonne affaire
                'DT_RowId'   => 'id_'.$user->getId()
            ];
        }
        return (new JsonResponse)->setData($data);
    }

    /*
     * Un controller permettant d'ajouter ou de modifier une Competition
     * via une popup
     */
    public function editAction(Request $request, $id = null) {
        $user = null;
        if(!is_null($id) && $id > 0)
            $user = $this->getDoctrine()->getRepository("UserBundle:User")->find($id);

        if (!$user) {
            $user = new User();
        }

        $form = $this->createForm(RegistrationFormType::class, $user,array(
            'method' => 'POST',
            'action' => $this->generateUrl('lcs_users_edit', array('id' => $id)),
        ));

        if(!is_null($id) && $id > 0) {
        	$form->remove('plainPassword');
        }

        $form->handleRequest($request);

        //Bien penser à tester si le formulaire est soumis
        if($form->isSubmitted()){
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                //Dans la popup on ne redirige pas sur une url mais on retourne une réponse
                //en json qui va afficher en toastr succees ce qui est marqué dans
                //le div de l'id modal-validation-message-creation dans ta vue add ("Le Competition a été créé avec succès")
                //traitement fait dans le fichier main.js
                return new JsonResponse([
                    'res' => true,
                    'type' => 'user',
                    'id' => $user->getId(),
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
        $nomUser = $user ? $user->getUsername() : null;
        return $this->render('LCSBundle:User:edit.html.twig', array(
            'user' => $nomUser,
            'form' => $form->createView()
        ));
    }
}

<?php

namespace App\UserBundle\Controller;

use App\UserBundle\Entity\Joueur;
use App\UserBundle\Entity\User;
use App\UserBundle\Form\JoueurType;
use App\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Joueur controller.
 *
 */
class JoueurController extends Controller {

    /**
     * Lists all Joueur entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $joueurs = $em->getRepository('AppUserBundle:Joueur')->findAll();

        return $this->render('AppUserBundle:joueur:index.html.twig', array(
                    'joueurs' => $joueurs,
        ));
    }

    public function getUploadRootDir() {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    public function getUploadDir() {
        return 'uploads/users';
    }

    /**
     * Creates a new Joueur entity.
     *
     */
    public function newAction(Request $request) {

        $em = $this->getDoctrine()->getEntityManager();
        $user = new User();
        $formpassword = $this->createForm(new UserType($request), $user);
        $joueur = new Joueur();
        $form = $this->createForm(new JoueurType($em));
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $joueur = $form->getData();
            $uploaded_file = $request->files->all();
            $pictutre_file = $uploaded_file['user']['file'][0];
            $pictutre_file2 = $uploaded_file['joueur']['file2'];
            if ($pictutre_file != null) {
                $filename = md5(uniqid()) . '.' . $pictutre_file->guessextension();
                $pictutre_file->move($this->getuploadrootdir(), $filename);
            } else {
                $filename = 'avatar.jpg';
            }
            if ($pictutre_file2 != null) {
                $filename2 = md5(uniqid()) . '.' . $pictutre_file2->guessextension();
                $pictutre_file2->move($this->getuploadrootdir(), $filename2);
            } else {
                $filename2 = 'avatar.jpg';
            }

            if($joueur->getCapitaine()==1){
                $user->setRoles(array('ROLE_ADMIN'));
                $user->setType(1);
                $user->setEnabled(1);
            }else{
                $user->setType(2);
                $user->setRoles(array('ROLE_USER'));
            }
            $user->setPicture($filename);
            //$request->request->get('user')['plainPassword']['first']
            $user->setEmail($request->request->get('user')['email']);
            $hash = $this->get('security.password_encoder')->encodePassword($user, $request->request->get('user')['plainPassword']['first']);
            $user->setPassword($hash);
            $user->setUsername($joueur->getNomPrenom());
            $em->persist($user);
            $em->flush();
            $joueur = $form->getData();
            $joueur->setIdcompte($user);
            $joueur->setPicture2($filename2);
            $em->persist($joueur);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Joueur Bien Ajouté'));
            return $this->redirectToRoute('joueur_index');
        }

        return $this->render('AppUserBundle:joueur:new.html.twig', array(
                    'joueur' => $joueur,
                    'formpassword' => $formpassword->createView(),
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Joueur entity.
     *
     */
    public function showAction(Joueur $joueur) {
        $deleteForm = $this->createDeleteForm($joueur);

        return $this->render('AppUserBundle:joueur:show.html.twig', array(
                    'joueur' => $joueur,
        ));
    }

    /**
     * Displays a form to edit an existing Joueur entity.
     *
     */
    public function editAction(Request $request, Joueur $joueur) {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('AppUserBundle:User')->findOneById($joueur->getIdcompte()->getId());
        $formpassword = $this->createForm(new UserType($request),$user);
        $form = $this->createForm(new JoueurType($em),  $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $joueur = $form->getData();
            $uploaded_file = $request->files->all();
            $pictutre_file = $uploaded_file['user']['file'][0];
            $pictutre_file2 = $uploaded_file['joueur']['file2'];
            if ($pictutre_file != null) {
                $filename = md5(uniqid()) . '.' . $pictutre_file->guessextension();
                $pictutre_file->move($this->getuploadrootdir(), $filename);
            } else {
                $filename = 'avatar.jpg';
            }
            if ($pictutre_file2 != null) {
                $filename2 = md5(uniqid()) . '.' . $pictutre_file2->guessextension();
                $pictutre_file2->move($this->getuploadrootdir(), $filename2);
            } else {
                $filename2 = 'avatar.jpg';
            }
            $user->setPicture($filename);
            //$request->request->get('user')['plainPassword']['first']
            $user->setEmail($request->request->get('user')['email']);
            if(!empty($request->request->get('user')['plainPassword']['first'])){
            $hash = $this->get('security.password_encoder')->encodePassword($user, $request->request->get('user')['plainPassword']['first']);
            $user->setPassword($hash);
            }
            $user->setUsername($joueur->getNomPrenom());
            $user->setType(2);
            $em->persist($user);
            $em->flush();
            $joueur = $form->getData();
            $joueur->setIdcompte($user);
            $joueur->setPicture2($filename2);
            $em->persist($joueur);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Joueur Bien Modifié'));
            return $this->redirectToRoute('joueur_index');
        }

            return $this->render('AppUserBundle:joueur:edit.html.twig', array(
                    'joueur' => $joueur,
                    'formpassword' => $formpassword->createView(),
                    'form' => $form->createView(),
            ));
        }

        /**
         * Deletes a Joueur entity.
         *
         */
        public function deleteAction(Joueur $joueur) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($joueur);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Joueur Bien supprimé'));

            return $this->redirectToRoute('joueur_index');
        }

    }
    
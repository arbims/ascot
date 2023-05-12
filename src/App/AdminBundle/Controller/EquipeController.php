<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\AdminBundle\Entity\Equipe;
use App\AdminBundle\Form\EquipeType;
use App\AdminBundle\Controller\AdresseController;

/**
 * Equipe controller.
 *
 */
class EquipeController extends Controller {

    /**
     * repertoire des image
     * @return string
     */
    protected function getUploadRootDir() {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * nom de repertoire
     * @return string
     */
    protected function getUploadDir() {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/equipe/';
    }

    /**
     * Lists all Equipe entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $equipes = $em->getRepository('AppAdminBundle:Equipe')->getall();
      
        return $this->render('AppAdminBundle:equipe:index.html.twig', array(
                    'equipes' => $equipes,
        ));
    }

    /**
     * Creates a new Equipe entity.
     *
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $equipe = new Equipe();
        $form = $this->createForm(new EquipeType($em), $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $ville = $request->request->get('equipe')['ville'];
            $equipe = $form->getData();
            $server = $request->headers->get('referer');
            $entity = explode('/', $server);
            $entity = $entity[7];
            $action = explode('/', $server);
            $action = end($action);
            $route = $entity . '_' . $action;
            $files = $request->files->all();
            $pictutre_file = $files['equipe']['file'] ;
            if($pictutre_file != null)
            {
                $fileName = md5(uniqid()) . '.' . $pictutre_file->guessextension();
                $pictutre_file->move($this->getUploadRootDir(), $fileName);
            }else {
                $fileName = 'avatar.jpg';
            }
            $equipe->setPicture($fileName);
            $pictutre_file2 = $files['equipe']['file2'] ;
            if($pictutre_file2 != null)
            {
                $fileName2 = md5(uniqid()) . '.' . $pictutre_file2->guessextension();
                $pictutre_file2->move($this->getUploadRootDir(), $fileName2);
            }else {
                $fileName2 = 'avatar.jpg';
            }
            $equipe->setPicture2($fileName2);
            //debug($route); die;
            //debug($entity); die;
            $equipe->setVille($ville);
            $em->persist($equipe);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Equipe Bien ajoutée'));
            if($route=='poule_new'){
                return $this->redirectToRoute($route);
            }else{
                return $this->redirectToRoute('equipe_index');
            }
        }

        return $this->render('AppAdminBundle:equipe:new.html.twig', array(
                    'equipe' => $equipe,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Equipe entity.
     *
     */
    public function showAction(Equipe $equipe) {
        $deleteForm = $this->createDeleteForm($equipe);

        return $this->render('AppAdminBundle:equipe:show.html.twig', array(
                    'equipe' => $equipe,
        ));
    }

    /**
     * Displays a form to edit an existing Equipe entity.
     *
     */
    public function editAction(Request $request, Equipe $equipe) {
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm(new EquipeType($em), $equipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            $em->persist($equipe);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Equipe Bien Modifiée'));
            return $this->redirectToRoute('equipe_index');
        }

        return $this->render('AppAdminBundle:equipe:edit.html.twig', array(
                    'equipe' => $equipe,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Equipe entity.
     *
     */
    public function deleteAction(Equipe $equipe) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($equipe);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Equipe Bien supprimée'));
        return $this->redirectToRoute('equipe_index');
    }

    public function listjouerAction($id){
        $em = $this->getDoctrine()->getManager();
        $joueurs = $em->getRepository('AppUserBundle:Joueur')->getjouerbyequipe($id);
        
        return $this->render('AppAdminBundle:equipe:listjoueur.html.twig',array('joueurs'=>$joueurs));
    }
    
    public function listdoubetAction($id){
        $em = $this->getDoctrine()->getManager();
        $doublets = $em->getRepository('AppAdminBundle:Doublet')->getdoubletbyequipe($id);
        
        return $this->render('AppAdminBundle:equipe:listdoublet.html.twig',array('doublets'=>$doublets));
    }
}

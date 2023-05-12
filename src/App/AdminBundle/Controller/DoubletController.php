<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\AdminBundle\Entity\Doublet;
use App\AdminBundle\Form\DoubletType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Doublet controller.
 *
 */
class DoubletController extends Controller {

    /**
     * Lists all Doublet entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $doublets = $em->getRepository('AppAdminBundle:Doublet')->findAll();

        return $this->render('AppAdminBundle:doublet:index.html.twig', array(
                    'doublets' => $doublets,
        ));
    }

    /**
     * Creates a new Doublet entity.
     *
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $doublet = new Doublet();
        $form = $this->createForm('App\AdminBundle\Form\DoubletType', $doublet);
        $form->handleRequest($request);
        $formjoueur = $this->createForm(new \App\UserBundle\Form\JoueurType($em));
        if ($form->isSubmitted()) {
            $data = $form->getData();
            $listjoueur = $_POST['doublet']['listjoueur'];

            $em->persist($doublet);
            $em->flush();
            foreach ($listjoueur as $k => $v) {
                $joueur = $em->getRepository('AppUserBundle:Joueur')->findOneById($v);
                $joueur->setDoublet($doublet);
                $em->persist($joueur);
                $em->flush();
            }
        $this->get('session')->getFlashBag()->add('notice', array('type'=>'success','message'=>'Doublet bien ajouté'));
            return $this->redirectToRoute('doublet_index');
        }

        return $this->render('AppAdminBundle:doublet:new.html.twig', array(
                    'doublet' => $doublet,
                    'formjoueur' => $formjoueur->createView(),
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Doublet entity.
     *
     */
    public function showAction(Doublet $doublet) {
        $deleteForm = $this->createDeleteForm($doublet);

        return $this->render('AppAdminBundle:doublet:show.html.twig', array(
                    'doublet' => $doublet,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Doublet entity.
     *
     */
    public function editAction(Request $request, Doublet $doublet) {

        $editForm = $this->createForm('App\AdminBundle\Form\DoubletType', $doublet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($doublet);
            $em->flush();

            return $this->redirectToRoute('doublet_edit', array('id' => $doublet->getId()));
        }

        return $this->render('AppAdminBundle:doublet:edit.html.twig', array(
                    'doublet' => $doublet,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Doublet entity.
     *
     */
    public function deleteAction(Doublet $doublet) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($doublet);
        $em->flush();

        return $this->redirectToRoute('doublet_index');
    }

    public function listjoueurAction(Request $request, $id) {

        $em = $this->getDoctrine()->getEntityManager();

        $response = new Response();
        if ($request->isXmlHttpRequest()) {
            $listjoueur = $em->getRepository('AppUserBundle:Joueur')->findlistJoueurByEquipe($id);
        }
        $response->setContent(json_encode($listjoueur));
        return $response;
    }

    public function detailjoueurAction($id) {
        $em = $this->getDoctrine()->getManager();
        $detailjoueur = $em->getRepository('AppUserBundle:Joueur')->getdetailjoueurbydoublet($id);
        //debug($detailjoueur); die;
        return $this->render('AppAdminBundle:doublet:detailjoueurbydoublet.html.twig'
                        , array('detailjoueur' => $detailjoueur));
    }

}

<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\AdminBundle\Entity\Ville;
use App\AdminBundle\Form\VilleType;

/**
 * Ville controller.
 *
 */
class VilleController extends Controller {

    /**
     * Lists all Ville entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $villes = $em->getRepository('AppAdminBundle:Ville')->getall();
        //debug($villes); die;
        return $this->render('AppAdminBundle:ville:index.html.twig', array(
                    'villes' => $villes,
        ));
    }

    /**
     * Creates a new Ville entity.
     *
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $ville = new Ville();
        $form = $this->createForm(new VilleType($em), $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($ville);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Ville Bien Ajoutée'));
            return $this->redirectToRoute('ville_index');
        }

        return $this->render('AppAdminBundle:ville:new.html.twig', array(
                    'ville' => $ville,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ville entity.
     *
     */
    public function showAction(Ville $ville) {
        $deleteForm = $this->createDeleteForm($ville);

        return $this->render('ville/show.html.twig', array(
                    'ville' => $ville,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ville entity.
     *
     */
    public function editAction(Request $request, Ville $ville) {
        $em = $this->getDoctrine()->getEntityManager();
        $editForm = $this->createForm(new VilleType($em), $ville);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Ville Bien Modifiée'));
            return $this->redirectToRoute('ville_index');
        }

        return $this->render('AppAdminBundle:ville:edit.html.twig', array(
                    'ville' => $ville,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Ville entity.
     *
     */
    public function deleteAction(Ville $ville) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($ville);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Ville Bien supprimée'));
        return $this->redirectToRoute('ville_index');
    }

}

<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Pays;
use App\AdminBundle\Form\PaysType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pays controller.
 *
 */
class PaysController extends Controller {

    /**
     * Lists all Pays entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $pays = $em->getRepository('AppAdminBundle:Pays')->findAll();

        return $this->render('AppAdminBundle:pays:index.html.twig', array(
                    'pays' => $pays,
        ));
    }

    /**
     * Creates a new Pays entity.
     *
     */
    public function newAction(Request $request) {
        $pay = new Pays();
        $form = $this->createForm(new PaysType(), $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pay);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Pays Bien Ajouté'));
            return $this->redirectToRoute('pays_index');
        }

        return $this->render('AppAdminBundle:pays:new.html.twig', array(
                    'pay' => $pay,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pays entity.
     *
     */
    public function editAction(Request $request, Pays $pay) {
        $editForm = $this->createForm('App\AdminBundle\Form\PaysType', $pay);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pay);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Pays Bien Modifié'));

            return $this->redirectToRoute('pays_index');
        }

        return $this->render('AppAdminBundle:pays:edit.html.twig', array(
                    'pays' => $pay,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Pays entity.
     *
     */
    public function deleteAction(Pays $pay) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($pay);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Pays Bien supprimé'));

        return $this->redirectToRoute('pays_index');
    }

}

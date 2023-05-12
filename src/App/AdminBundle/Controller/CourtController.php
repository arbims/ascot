<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\AdminBundle\Entity\Court;
use App\AdminBundle\Form\CourtType;

/**
 * Court controller.
 *
 */
class CourtController extends Controller
{
    /**
     * Lists all Court entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $courts = $em->getRepository('AppAdminBundle:Court')->findAll();

        return $this->render('AppAdminBundle:court:index.html.twig', array(
            'courts' => $courts,
        ));
    }

    /**
     * Creates a new Court entity.
     *
     */
    public function newAction(Request $request)
    {
        $court = new Court();
        $form = $this->createForm('App\AdminBundle\Form\CourtType', $court);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($court);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Court Bien ajouté'));

            return $this->redirectToRoute('court_index');
        }

        return $this->render('AppAdminBundle:court:new.html.twig', array(
            'court' => $court,
            'form' => $form->createView(),
        ));
    }

 

    /**
     * Displays a form to edit an existing Court entity.
     *
     */
    public function editAction(Request $request, Court $court)
    {
       
        $editForm = $this->createForm('App\AdminBundle\Form\CourtType', $court);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($court);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Court Bien Modifié'));

            return $this->redirectToRoute('court_index');
        }

        return $this->render('AppAdminBundle:court:edit.html.twig', array(
            'court' => $court,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Court entity.
     *
     */
    public function deleteAction(Court $court)
    {
      
            $em = $this->getDoctrine()->getManager();
            $em->remove($court);
            $em->flush();

        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Court Bien Supprimé'));

        return $this->redirectToRoute('court_index');
    }

    
}

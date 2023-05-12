<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\AdminBundle\Entity\Espaceuser;
use App\AdminBundle\Form\EspaceuserType;

/**
 * Espaceuser controller.
 *
 */
class EspaceuserController extends Controller
{
    /**
     * Lists all Espaceuser entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $espaceusers = $em->getRepository('AppAdminBundle:Espaceuser')->findAll();

        return $this->render('AppAdminBundle:espaceuser:index.html.twig', array(
            'espaceusers' => $espaceusers,
        ));
    }

    /**
     * Creates a new Espaceuser entity.
     *
     */
    public function newAction(Request $request)
    {
        $espaceuser = new Espaceuser();
        $form = $this->createForm('App\AdminBundle\Form\EspaceuserType', $espaceuser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($espaceuser);
            $em->flush();

            return $this->redirectToRoute('espaceuser_show', array('id' => $espaceuser->getId()));
        }

        return $this->render('AppAdminBundle:espaceuser:new.html.twig', array(
            'espaceuser' => $espaceuser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Espaceuser entity.
     *
     */
    public function showAction(Espaceuser $espaceuser)
    {
        $deleteForm = $this->createDeleteForm($espaceuser);

        return $this->render('AppAdminBundle:espaceuser:show.html.twig', array(
            'espaceuser' => $espaceuser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Espaceuser entity.
     *
     */
    public function editAction(Request $request, Espaceuser $espaceuser)
    {
        $deleteForm = $this->createDeleteForm($espaceuser);
        $editForm = $this->createForm('App\AdminBundle\Form\EspaceuserType', $espaceuser);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($espaceuser);
            $em->flush();

            return $this->redirectToRoute('espaceuser_edit', array('id' => $espaceuser->getId()));
        }

        return $this->render('AppAdminBundle:espaceuser:edit.html.twig', array(
            'espaceuser' => $espaceuser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Espaceuser entity.
     *
     */
    public function deleteAction(Request $request, Espaceuser $espaceuser)
    {
        $form = $this->createDeleteForm($espaceuser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($espaceuser);
            $em->flush();
        }

        return $this->redirectToRoute('espaceuser_index');
    }

    /**
     * Creates a form to delete a Espaceuser entity.
     *
     * @param Espaceuser $espaceuser The Espaceuser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Espaceuser $espaceuser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('espaceuser_delete', array('id' => $espaceuser->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

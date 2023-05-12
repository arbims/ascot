<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\AdminBundle\Entity\Evaluation;
use App\AdminBundle\Form\EvaluationType;

/**
 * Evaluation controller.
 *
 */
class EvaluationController extends Controller
{
    /**
     * Lists all Evaluation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evaluations = $em->getRepository('AppAdminBundle:Evaluation')->findAll();

        return $this->render('evaluation/index.html.twig', array(
            'evaluations' => $evaluations,
        ));
    }

    /**
     * Creates a new Evaluation entity.
     *
     */
    public function newAction(Request $request)
    {
        $evaluation = new Evaluation();
        $form = $this->createForm('App\AdminBundle\Form\EvaluationType', $evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluation);
            $em->flush();

            return $this->redirectToRoute('evaluation_show', array('id' => $evaluation->getId()));
        }

        return $this->render('evaluation/new.html.twig', array(
            'evaluation' => $evaluation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Evaluation entity.
     *
     */
    public function showAction(Evaluation $evaluation)
    {
        $deleteForm = $this->createDeleteForm($evaluation);

        return $this->render('evaluation/show.html.twig', array(
            'evaluation' => $evaluation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Evaluation entity.
     *
     */
    public function editAction(Request $request, Evaluation $evaluation)
    {
        $deleteForm = $this->createDeleteForm($evaluation);
        $editForm = $this->createForm('App\AdminBundle\Form\EvaluationType', $evaluation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluation);
            $em->flush();

            return $this->redirectToRoute('evaluation_edit', array('id' => $evaluation->getId()));
        }

        return $this->render('evaluation/edit.html.twig', array(
            'evaluation' => $evaluation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Evaluation entity.
     *
     */
    public function deleteAction(Request $request, Evaluation $evaluation)
    {
        $form = $this->createDeleteForm($evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evaluation);
            $em->flush();
        }

        return $this->redirectToRoute('evaluation_index');
    }

    /**
     * Creates a form to delete a Evaluation entity.
     *
     * @param Evaluation $evaluation The Evaluation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Evaluation $evaluation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evaluation_delete', array('id' => $evaluation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

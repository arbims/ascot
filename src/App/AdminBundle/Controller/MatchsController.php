<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\AdminBundle\Entity\Matchs;
use App\AdminBundle\Form\MatchsType;

/**
 * Matchs controller.
 *
 */
class MatchsController extends Controller
{
    /**
     * Lists all Matchs entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $matchs = $em->getRepository('AppAdminBundle:Matchs')->findAll();

        return $this->render('AppAdminBundle:matchs:index.html.twig', array(
            'matchs' => $matchs,
        ));
    }

    /**
     * Creates a new Matchs entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $match = new Matchs();
        $form = $this->createForm(new MatchsType(), $match);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($match);
            $em->flush();
            return $this->redirectToRoute('matchs_index');
        }
        return $this->render('AppAdminBundle:matchs:new.html.twig', array(
            'match' => $match,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Matchs entity.
     *
     */
    public function showAction(Matchs $match)
    {
        $deleteForm = $this->createDeleteForm($match);

        return $this->render('AppAdminBundle:matchs:show.html.twig', array(
            'match' => $match,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Matchs entity.
     *
     */
    public function editAction(Request $request, Matchs $match)
    {
        $deleteForm = $this->createDeleteForm($match);
        $editForm = $this->createForm(new MatchsType(), $match);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($match);
            $em->flush();
            return $this->redirectToRoute('matchs_edit', array('id' => $match->getId()));
        }
        return $this->render('AppAdminBundle:matchs:edit.html.twig', array(
            'match' => $match,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Matchs entity.
     *
     */
    public function deleteAction(Matchs $match)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($match);
        $em->flush();
        return $this->redirectToRoute('matchs_index');
    }


    public function setscoreAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $match = $em->getRepository('AppAdminBundle:Matchs')->findOneById($request->request->get('id'));
        $match->setScoreEq1Match($request->request->get('score_eq1_match'));
        $match->setScoreEq2Match($request->request->get('score_eq2_match'));
        return $this->redirect($request->headers->get('referer'));
    }

}

<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\AdminBundle\Entity\Notification;
use App\AdminBundle\Form\NotificationType;

/**
 * Notification controller.
 *
 */
class NotificationController extends Controller
{
    /**
     * Lists all Notification entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $notifications = $em->getRepository('AppAdminBundle:Notification')->findAll();

        return $this->render('notification/index.html.twig', array(
            'notifications' => $notifications,
        ));
    }

    /**
     * Creates a new Notification entity.
     *
     */
    public function newAction(Request $request)
    {
        $notification = new Notification();
        $form = $this->createForm('App\AdminBundle\Form\NotificationType', $notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($notification);
            $em->flush();

            return $this->redirectToRoute('notification_show', array('id' => $notification->getId()));
        }

        return $this->render('notification/new.html.twig', array(
            'notification' => $notification,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Notification entity.
     *
     */
    public function showAction(Notification $notification)
    {
        $deleteForm = $this->createDeleteForm($notification);

        return $this->render('notification/show.html.twig', array(
            'notification' => $notification,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Notification entity.
     *
     */
    public function editAction(Request $request, Notification $notification)
    {
        $deleteForm = $this->createDeleteForm($notification);
        $editForm = $this->createForm('App\AdminBundle\Form\NotificationType', $notification);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($notification);
            $em->flush();

            return $this->redirectToRoute('notification_edit', array('id' => $notification->getId()));
        }

        return $this->render('notification/edit.html.twig', array(
            'notification' => $notification,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Notification entity.
     *
     */
    public function deleteAction(Request $request, Notification $notification)
    {
        $form = $this->createDeleteForm($notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($notification);
            $em->flush();
        }

        return $this->redirectToRoute('notification_index');
    }

    /**
     * Creates a form to delete a Notification entity.
     *
     * @param Notification $notification The Notification entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Notification $notification)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('notification_delete', array('id' => $notification->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

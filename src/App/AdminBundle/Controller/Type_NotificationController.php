<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\AdminBundle\Entity\Type_Notification;
use App\AdminBundle\Form\Type_NotificationType;
/**
 * Type_Notification controller.
 *
 */
class Type_NotificationController extends Controller
{
    /**
     * Lists all Type_Notification entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $type_Notifications = $em->getRepository('AppAdminBundle:Type_Notification')->findAll();

        return $this->render('type_notification/index.html.twig', array(
            'type_Notifications' => $type_Notifications,
        ));
    }

    /**
     * Creates a new Type_Notification entity.
     *
     */
    public function newAction(Request $request)
    {
        $type_Notification = new Type_Notification();
        $form = $this->createForm('App\AdminBundle\Form\Type_NotificationType', $type_Notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type_Notification);
            $em->flush();

            return $this->redirectToRoute('type_notification_show', array('id' => $type_notification->getId()));
        }

        return $this->render('type_notification/new.html.twig', array(
            'type_Notification' => $type_Notification,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Type_Notification entity.
     *
     */
    public function showAction(Type_Notification $type_Notification)
    {
        $deleteForm = $this->createDeleteForm($type_Notification);

        return $this->render('type_notification/show.html.twig', array(
            'type_Notification' => $type_Notification,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Type_Notification entity.
     *
     */
    public function editAction(Request $request, Type_Notification $type_Notification)
    {
        $deleteForm = $this->createDeleteForm($type_Notification);
        $editForm = $this->createForm('App\AdminBundle\Form\Type_NotificationType', $type_Notification);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type_Notification);
            $em->flush();

            return $this->redirectToRoute('type_notification_edit', array('id' => $type_Notification->getId()));
        }

        return $this->render('type_notification/edit.html.twig', array(
            'type_Notification' => $type_Notification,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Type_Notification entity.
     *
     */
    public function deleteAction(Request $request, Type_Notification $type_Notification)
    {
        $form = $this->createDeleteForm($type_Notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($type_Notification);
            $em->flush();
        }

        return $this->redirectToRoute('type_notification_index');
    }

    /**
     * Creates a form to delete a Type_Notification entity.
     *
     * @param Type_Notification $type_Notification The Type_Notification entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Type_Notification $type_Notification)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('type_notification_delete', array('id' => $type_Notification->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Event;
use App\AdminBundle\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller {

    /**
     * @return Response
     * retourner la calndrier
     */
    public function fullcalandeeventAction() {
        $em = $this->getDoctrine()->getManager();
        $response = new Response();
        $event = $em->getRepository('AppAdminBundle:Event')->findAll();
        $data = [];
        foreach ($event as $k => $v) {
            // $this->debug($maxvalue);
            $data[] = array('id' => $v->getId(), 'title' => $v->getTimeevent() . ':' . $v->getTitreevent(), 'start' => $v->getDateevent());
        }
        //$serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new jsonEncoder()));
        //$output = $serializer->serialize($event, 'json');
        $output = json_encode($data);

        return $this->render('AppAdminBundle:Event:fullcalander.html.twig', array('events' => $output));
    }

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('AppAdminBundle:Event')->findAll();
        return $this->render('AppAdminBundle:event:index.html.twig', array('events' => $events));
    }

    public function addAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $event = new Event();
        $form = $this->createForm(new EventType(), $event);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $event = $form->getData();
            $em->persist($event);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Evénement Bien Ajouté'));
            return $this->redirectToRoute('event_index');
        }

        return $this->render('AppAdminBundle:event:add.html.twig', array('form' => $form->createView()));
    }

    public function editAction(Request $request, Event $event) {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new EventType(), $event);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $event = $form->getData();
            $em->persist($event);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Evénement Bien Modifié'));
            return $this->redirectToRoute('event_index');
        }

        return $this->render('AppAdminBundle:event:edit.html.twig', array('form' => $form->createView(),
                    'event' => $event));
    }

    public function deleteAction(Request $request, Event $event) {
        $em = $this->getDoctrine()->getManager();
        $referer = $this->getRequest()->headers->get('referer');
        $em->remove($event);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Evénement Bien Supprimé'));
        return $this->redirectToRoute('event_index');
    }

    public function fullcalendarAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $response = new Response();
        $event = $em->getRepository('AppAdminBundle:Event')->findAll();
        $data = [];
        foreach ($event as $k => $v) {
            // $this->debug($maxvalue);
         
            $date = $v->getDate();
            $date = $date->format('Y-m-d');
            
            $data[] = array('id' => $v->getId(), 'title' => $v->getTitre() . ':' . $v->getDescription(), 'start' => $date);
        }
        //$serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new jsonEncoder()));
        //$output = $serializer->serialize($event, 'json');
        $output = json_encode($data);
        return $this->render('AppAdminBundle:event:fullcalendar.html.twig',array('events'=>$output));
    }

}

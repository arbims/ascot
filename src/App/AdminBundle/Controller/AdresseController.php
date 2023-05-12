<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdresseController extends Controller {

   

    public function getlistpays() {
        $em = $this->getDoctrine()->getEntityManager();
        $pays = $em->getRepository('AppAdminBundle:Pays')->findAll();
        return $pays;
    }

    public function getlistvilleAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $id = $request->request->get('datelist');
        $ville = $em->getRepository('AppAdminBundle:Ville')->getvillebyId($id);
        $response = new Response();
        $response->headers->set('NewslettresType', 'application/json');
        $response->setContent(json_encode($ville));
        return $response;
    }

}

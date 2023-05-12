<?php

namespace App\CapitaineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CapitaineController extends Controller{
    
    public function getSessionCapitaine()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser()->getId();
        $joueur = $em->getRepository('AppUserBundle:Joueur')->findOneByIdcompte($user);
        $equipe =$em->getRepository('AppUserBundle:Joueur')->getEquipe($joueur);
        $matchs = $em->getRepository('AppAdminBundle:Matchs')->getallbyequipe($equipe['equipe']['libelle']);
        return $matchs;
    }
    
    
    public function setscoreAction()
    {
        $matchs = $this->getSessionCapitaine();
        return $this->render('AppCapitaineBundle:capitaine:index.html.twig', array('matchs' => $matchs));
    }
    
    public function loginAction()
    {
    }
    
}

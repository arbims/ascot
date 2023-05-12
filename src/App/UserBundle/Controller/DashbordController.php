<?php

namespace App\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashbordController extends Controller{
   
    public function indexAction(){
        
        
        return $this->render('AppUserBundle:dashbord:index.html.twig');
    }
    
    public function redirectAction()
    {
        return $this->redirectToRoute('app_dashbord');
    }
}

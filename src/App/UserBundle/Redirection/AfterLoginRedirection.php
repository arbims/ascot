
<?php

namespace Pfe\AdminBundle\Redirection;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;


class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface {

    public $router;
            function __construct(RouterInterface $router) {
        $this->router = $router;
    }
    

    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        
        //recupere la liste des role
        $roles = $token->getRoles();
        $rolestab = array_map(function($role){
            return $role->getRole();
        },$roles);
        if(in_array('ROLE_SUPER_ADMIN', $rolestab, true))
                $redirection = new RedirectResponse($this->router->generate ('app_dashbord'));
        elseif (in_array('ROLE_ADMIN', $rolestab,true))
                $redirection = new RedirectResponse($this->router->generate ('set_score_match'));
        else
            $redirection = new RedirectResponse($this->router->generate ('inex_article'));
        return $redirection;
    }

}

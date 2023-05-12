<?php

namespace App\UserBundle\Controller;

use App\UserBundle\Entity\CompteAdmin;
use App\UserBundle\Entity\CompteUser;
use App\UserBundle\Entity\User;
use App\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 */
class UserController extends Controller {
    
    

    public function getUploadRootDir() {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    public function getUploadDir() {
        return 'uploads/users';
    }

    /**
     * Lists all User entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppUserBundle:User')->findallbycompteadmin();

        return $this->render('AppUserBundle:user:index.html.twig', array(
                    'users' => $users,
        ));
    }

    /**
     * Creates a new User entity.
     *
     */
    public function newAction(Request $request) {
        $user = new User();
        $form = $this->createForm(new UserType($request), $user);

        $em = $this->getDoctrine()->getEntityManager();
        $form->handleRequest($request);
        //var_dump($form->getData());die;
        if ($request->isMethod('POST') && $form->isValid()) {
            $user = $form->getData();
            $validusername = $this->checkusername($user->getUsername());
            if ($validusername == false) {
                return $this->redirectToRoute('user_new');
            } else {
                $uploaded_file = $request->files->all();
                $pictutre_file = $uploaded_file['user']['file'][0];
                if ($pictutre_file != null) {
                    $filename = md5(uniqid()) . '.' . $pictutre_file->guessextension();
                    $pictutre_file->move($this->getuploadrootdir(), $filename);
                } else {
                    $filename = 'avatar.jpg';
                }

                $nom = $form->get('nom')->getData();
                $prenom = $form->get('nom')->getData();
                $user->setPicture($filename);
                $user->setType(1);
                $em->persist($user);
                $em->flush();

                $useradmin = new CompteAdmin();
                $useradmin->setNom($nom);
                $useradmin->setPrenom($prenom);
                $useradmin->setIdcompte($user);
                $em->persist($useradmin);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Utilisateur Bien Ajouté'));
                return $this->redirectToRoute('user_index');
            }
        }
        return $this->render('AppUserBundle:user:new.html.twig', array(
                    'user' => $user,
                    'form' => $form->createView(),
                    'formuser' => $form->createView()
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction(User $user) {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
                    'user' => $user,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction(Request $request, User $user) {
        $em = $this->getDoctrine()->getEntityManager();
        $usertype = $em->getRepository('AppUserBundle:CompteAdmin')->findOneByIdcompte($user->getId());
      
        $form = $this->createForm(new UserType($request), $user);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $user = $form->getData();
            $uploaded_file = $request->files->all();
            $pictutre_file = $uploaded_file['user']['file'][0];
            if ($pictutre_file != null) {
                $filename = md5(uniqid()) . '.' . $pictutre_file->guessextension();
                $pictutre_file->move($this->getuploadrootdir(), $filename);
            } else {
                $filename = 'avatar.jpg';
            }

            $nom = $form->get('nom')->getData();
            $prenom = $form->get('nom')->getData();
            $user->setPicture($filename);
            $user->setType(1);
            $em->persist($user);
            $em->flush();

            $useradmin = $em->getRepository('AppUserBundle:CompteAdmin')->findOneByIdcompte($user->getId());
            $useradmin->setNom($nom);
            $useradmin->setPrenom($prenom);
            $useradmin->setIdcompte($user);
            $em->persist($useradmin);

            $em->flush();
        


        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Utilisateur Bien Modifié'));
        return $this->redirectToRoute('user_index');
        }
        return $this->render('AppUserBundle:user:edit.html.twig', array(
                    'user' => $user,
                    'usertype' => $usertype,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(User $user) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Utilisateur Bien supprimé'));
        return $this->redirectToRoute('user_index');
    }

    public function profileAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userentity = $em->getRepository('AppUserBundle:User')->getuserbyid($user->getId());

        if ($userentity['type'] = 1) {
            $usercompte = $em->getRepository('AppUserBundle:CompteAdmin')->findOneByIdcompte($user->getId());
        } else {
            $usercompte = $em->getRepository('AppUserBundle:CompteUser')->findOneByIdcompte($user->getId());
        }

        if ($request->isMethod('POST')) {
            $nom = $request->request->get('user')['nom'];
            $prenom = $request->request->get('user')['prenom'];
            $tel = $request->request->get('user')['numtel'];
            $userentity = $em->getRepository('AppUserBundle:User')->getuserbyid($user->getId());
            if ($userentity['type'] = 1) {
                $useradmin = $em->getRepository('AppUserBundle:CompteAdmin')->findOneByIdcompte($user->getId());

                if (!isset($useradmin)) {
                    $useradmin = new CompteAdmin();
                    $useradmin->setIdcompte($user);
                    $useradmin->setNom($nom);
                    $useradmin->setPrenom($prenom);
                    $useradmin->setNumtel($tel);
                    $em->persist($useradmin);
                    $em->flush();
                } else {
                    $useradmin->setNom($nom);
                    $useradmin->setPrenom($prenom);
                    $useradmin->setNumtel($tel);
                    $em->persist($useradmin);
                    $em->flush();
                }
            }
        }
        return $this->render('AppUserBundle:user:profile.html.twig', array(
                    'user' => $user,
                    'usercompte' => $usercompte
        ));
    }

    public function checkusername($email) {
        $res = true;
        $em = $this->getDoctrine()->getEntityManager();
        $username = $em->getRepository('AppUserBundle:User')->findAll();
        foreach ($username as $k => $v) {
            if ($email == $v->getUsername())
                $res = false;
        }
        return $res;
    }

}

<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Actualite;
use App\AdminBundle\Entity\Medias;
use App\AdminBundle\Form\ActualiteType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Actualite controller.
 *
 */
class ActualiteController extends Controller {

    /**
     * Lists all Actualite entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('AppAdminBundle:Actualite')->findAll();

        return $this->render('AppAdminBundle:actualite:index.html.twig', array(
                    'actualites' => $actualites,
        ));
    }

    /**
     * repertoire des image
     * @return string
     */
    protected function getUploadRootDir() {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * nom de repertoire
     * @return string
     */
    protected function getUploadDir() {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/actualite/';
    }

    /**
     * Creates a new Actualite entity.
     *
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $actualite = new Actualite();
        $form = $this->createForm(new ActualiteType($em), $actualite);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $actualite = $form->getData();
            if ($request->request->get('actualite')['type'] == '1' ||
                    $request->request->get('actualite')['type'] == '3') {
                //debug($request->request->get('actualite')); die;

                $filenamedata = $request->get('file');
                $directory = $this->getUploadRootDir();
                $directorysend = 'actualite/';
                $nameinput = 'actualite';
                $uploadcontrolle = $this->get('Repository_uploadfileController');
                $datapicture = $uploadcontrolle->pageuploadimageAction($request, $directory, $nameinput, $directorysend, $thumb = null);
                //$actualite->setDate(new \DateTime());
                $em->persist($actualite);

                $em->flush();

                //$idpage = $em->getRepository('AppModelBundle:Pages')->getlastId();

                foreach ($datapicture as $key => $data) {
                    foreach ($data as $k => $v) {
                        $picturepage = new Medias();
                        $picturepage->setName($v['name']);
                        $picturepage->setActualite($actualite);
                        $picturepage->setType('image');
                        $em->persist($picturepage);
                        $em->flush();
                    }
                }
            } else {
               
                $video = $request->request->get('actualite')['file'][0];
                 
                 $video = explode('=',$video);
               
                //$actualite->setDate(new \DateTime());
                $em->persist($actualite);
                $em->flush();
                $picturepage = new Medias();
                $picturepage->setName($video[1]);
                $picturepage->setActualite($actualite);
                $picturepage->setType('video');
                $em->persist($picturepage);
                $em->flush();
            }
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Actualité Bien Ajoutée'));
            return $this->redirectToRoute('actualite_index');
        }
        return $this->render('AppAdminBundle:actualite:new.html.twig', array(
                    'actualite' => $actualite,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Actualite entity.
     *
     */
    public function editAction(Request $request, Actualite $actualite) {
        $em = $this->getDoctrine()->getEntityManager();
        $gallerie = $em->getRepository('AppAdminBundle:Medias')->findByActualite($actualite->getId());
        $form = $this->createForm(new ActualiteType($em), $actualite);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $actualite = $form->getData();
            if ($request->request->get('actualite')['type'] == '1' || $request->request->get('actualite')['type'] == '3') {
                //debug($request->request->get('actualite')); die;

                $filenamedata = $request->get('file');
                $directory = $this->getUploadRootDir();
                $directorysend = 'actualite/';
                $nameinput = 'actualite';
                $uploadcontrolle = $this->get('Repository_uploadfileController');
                $datapicture = $uploadcontrolle->pageuploadimageAction($request, $directory, $nameinput, $directorysend, $thumb = null);
                //$actualite->setDate(new \DateTime());
                $em->persist($actualite);

                $em->flush();

                //$idpage = $em->getRepository('AppModelBundle:Pages')->getlastId();

                foreach ($datapicture as $key => $data) {
                    foreach ($data as $k => $v) {
                        $picturepage = new Medias();
                        $picturepage->setName($v['name']);
                        $picturepage->setActualite($actualite);
                        $picturepage->setType('image');
                        $em->persist($picturepage);
                        $em->flush();
                    }
                }
            } else {
                //$actualite->setDate(new \DateTime());
                $em->persist($actualite);
                $em->flush();
                $picturepage = new Medias();
                $picturepage->setName('video');
                $picturepage->setActualite($actualite);
                $picturepage->setType('video');
                $em->persist($picturepage);
                $em->flush();
            }
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Actualité Bien Modifiée'));
            return $this->redirectToRoute('actualite_index');
        }
        return $this->render('AppAdminBundle:actualite:edit.html.twig', array(
                    'actualite' => $actualite,
                    'form' => $form->createView(),
                    'galleries' => $gallerie,
        ));
    }

    /**
     * Deletes a Actualite entity.
     *
     */
    public function deleteAction(Actualite $actualite) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($actualite);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Actualité bien supprimée'));
        return $this->redirectToRoute('actualite_index');
    }
    
    
    

}

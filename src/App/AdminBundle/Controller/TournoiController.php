<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Matchs;
use App\AdminBundle\Entity\Tournoi;
use App\AdminBundle\Form\TournoiType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Tournoi controller.
 *
 */
class TournoiController extends Controller {

    public function getUploadRootDir() {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    public function getUploadDir() {
        return 'uploads/logo';
    }

    /**
     * Lists all Tournoi entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $tournois = $em->getRepository('AppAdminBundle:Tournoi')->findAll();

        return $this->render('AppAdminBundle:tournoi:index.html.twig', array(
                    'tournois' => $tournois,
        ));
    }

    /**
     * Creates a new Tournoi entity.
     *
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $tournoi = new Tournoi();
        $form = $this->createForm(new TournoiType(), $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $files = $request->files->all();
            $pictutre_file = $files['tournoi']['file'];
            if ($pictutre_file != null) {
                $fileName = md5(uniqid()) . '.' . $pictutre_file->guessextension();
                $pictutre_file->move($this->getUploadRootDir(), $fileName);
            } else {
                $fileName = 'avatar.jpg';
            }
            $tournoi->setLogo($fileName);
            $em->persist($tournoi);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Tournoi bien ajouté'));
            return $this->redirectToRoute('tournoi_index');
        }

        return $this->render('AppAdminBundle:tournoi:new.html.twig', array(
                    'tournoi' => $tournoi,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tournoi entity.
     *
     */
    public function editAction(Request $request, Tournoi $tournoi) {
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm(new TournoiType(), $tournoi);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $files = $request->files->all();
            $pictutre_file = $files['tournoi']['file'];
            if ($pictutre_file != null) {
                $fileName = md5(uniqid()) . '.' . $pictutre_file->guessExtension();
                $pictutre_file->move($this->getUploadRootDir(), $fileName);
            } else {
                $fileName = 'avatar.jpg';
            }
            $tournoi->setLogo($fileName);
            $em->persist($tournoi);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Tournoi bien Modifié'));
            return $this->redirectToRoute('tournoi_index');
        }

        return $this->render('AppAdminBundle:tournoi:edit.html.twig', array(
                    'tournoi' => $tournoi,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Tournoi entity.
     *
     */
    public function deleteAction(Request $request, Tournoi $tournoi) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($tournoi);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Tournoi bien supprimé'));
        return $this->redirectToRoute('tournoi_index');
    }

    public function showAction(Request $request, Tournoi $tournoi) {
        $em = $this->getDoctrine()->getManager();
        $final = null;
        $champion = null;
        if ($tournoi->getStatut() == 2) {
            $final = $em->getRepository('AppAdminBundle:Matchs')->getmatchbyidtournoi($tournoi->getId());
        }
        if ($tournoi->getStatut() == 3) {
            $champion = $this->getChampion($tournoi->getId());
        }
        //debug($this->getChampion($tournoi->getId()));
        $demifinalcontrolle = $this->get('Repository_DemifinalController');
        $classment = $demifinalcontrolle->tournoi($tournoi);
        $demifinaldata = $em->getRepository('AppAdminBundle:Matchs')->getMatchdemifinal($tournoi->getId());
        //debug($demifinaldata);
        $matchclassmentdata = $em->getRepository('AppAdminBundle:Matchs')->getmatchclassment($tournoi->getId());
        //debug($matchclassmentdata); die;
        $court = $em->getRepository('AppAdminBundle:Court')->findAll();
        return $this->render('AppAdminBundle:tournoi:show.html.twig', array('classments' => $classment, 'tournoi' => $tournoi,
                    'demifinal' => $demifinaldata,
                    'court' => $court,
                    'matchclassment' => $matchclassmentdata,
                    'final' => $final,
                    'champion' => $champion
        ));
    }

    public function setetap3Action(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $tournoi = $em->getRepository('AppAdminBundle:Tournoi')->findOneById($request->request->get('id'));
        $this->saveMatchfinal($tournoi);
        $em = $this->getDoctrine()->getManager();
        $tournoi->setStatut(2);
        $em->persist($tournoi);
        $em->flush();

        $output = array('success' => true);
        $response = new Response();
        $response->headers->set('NewslettresType', 'application/json');
        $response->setContent(json_encode($output));
        return $response;
    }

    /**
     * Enregister les match de demi final
     * */
    public function saveMatchfinal($tournoi) {
        $em = $this->getDoctrine()->getManager();
        $finnal = [];
        $win_equipe = [];
        if ($tournoi->getStatut() == '1') {
            $data = $em->getRepository('AppAdminBundle:Matchs')->getScorematchdemifinal($tournoi->getId());
            foreach ($data as $k => $v) {
                $win1 = 0;
                $win2 = 0;
                foreach ($v['score'] as $kk => $vv) {
                    if ($vv['scoreEquipe1'] > $vv['scoreEquipe2']) {
                        $win_equipe[$k] = array('equipe1' => $v['equipe1'], 'win1' => $win1 = $win1 + 1, 'equipe2' => $v['equipe2'], 'win2' => $win2);
                    } else {
                        $win_equipe[$k] = array('equipe1' => $v['equipe1'], 'win1' => $win1, 'equipe2' => $v['equipe2'], 'win2' => $win2 = $win2 + 1);
                    }
                }
            }
        }

        foreach ($win_equipe as $k => $v) {
            if ($v['win1'] > $v['win2']) {
                $finnal[$k] = $v['equipe1'];
            } else if ($v['win2'] > $v['win1']) {
                $finnal[$k] = $v['equipe2'];
            }
        }

        $tournoi = $em->getRepository('AppAdminBundle:Tournoi')->findOneById($tournoi);

        $matchdemifinal = new Matchs();
        $matchdemifinal->setTournois($tournoi);
        $matchdemifinal->setEtapematch('final');
        $matchdemifinal->setEquipe1($finnal[0]);
        $matchdemifinal->setEquipe2($finnal[1]);
        $em->persist($matchdemifinal);
        $em->flush();
    }

    public function getChampion($id) {
        $em = $this->getDoctrine()->getManager();
        $champion = [];
        $win_equipe = [];

        $data = $em->getRepository('AppAdminBundle:Matchs')->getScorematchfinal($id);
        foreach ($data as $k => $v) {
            $win1 = 0;
            $win2 = 0;
            foreach ($v['score'] as $kk => $vv) {
                if ($vv['scoreEquipe1'] > $vv['scoreEquipe2']) {
                    $win_equipe[$k] = array('equipe1' => $v['equipe1'], 'win1' => $win1 = $win1 + 1, 'equipe2' => $v['equipe2'], 'win2' => $win2);
                } else {
                    $win_equipe[$k] = array('equipe1' => $v['equipe1'], 'win1' => $win1, 'equipe2' => $v['equipe2'], 'win2' => $win2 = $win2 + 1);
                }
            }
        }

        foreach ($win_equipe as $k => $v) {
            if ($v['win1'] > $v['win2']) {
                $champion[$k] = $v['equipe1'];
            } else if ($v['win2'] > $v['win1']) {
                $champion[$k] = $v['equipe2'];
            }
        }

        //debug($champion); die;
        return $champion;
    }

    public function setetapechampionAction(Request $request) {
        //debug($request); die;
        $em = $this->getDoctrine()->getManager();
        $tournoi = $em->getRepository('AppAdminBundle:Tournoi')->findOneById($request->request->get('id'));
        //$this->savefinal($tournoi);
        $em = $this->getDoctrine()->getManager();
        $tournoi->setStatut(3);
        $em->persist($tournoi);
        $em->flush();

        $output = array('success' => true);
        $response = new Response();
        $response->headers->set('NewslettresType', 'application/json');
        $response->setContent(json_encode($output));
        return $response;
    }

   
    

}

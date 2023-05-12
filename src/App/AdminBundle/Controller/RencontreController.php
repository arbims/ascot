<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Rencontre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Rencontre controller.
 *
 */
class RencontreController extends Controller {

    /**
     *
     * @param type $id
     * @return type
     */
    public function listmatchAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $matchs = $em->getRepository('AppAdminBundle:Poule')->getlistmatch($id);
        $equie = $matchs[0]['p_numberequipe'] ;
        //debug($equie%2); die;
        if($equie%2){
            $equiediv = $equie%2+1;
        }else{
            $equiediv = $equie/2 ;
        }
        $journee = count($matchs) / $equiediv;
        $journeematch = array();
        $i = 0;
        foreach ($matchs as $k => $v) {
            $journeematch[$i][] = $v;
            if ($k == $equiediv - 1) {
                $i++;
                $equiediv = $equiediv * 2;
            }
        }
        $poule = $em->getRepository('AppAdminBundle:Poule')->getpoule();
        $poule_data = array();
        foreach ($poule as $k => $v) {
            $poule_data[$v['id']] = array('id' => $v['id'], 'name' => $v['libelle']);
            $poule_id = $v['id'];
        }

        $journee_array = [];
        for ($i = 0; $i < $journee; $i++) {
            $journee_array[$i] = $i + 1;
        }
        $court = $em->getRepository('AppAdminBundle:Court')->findAll();
        return $this->render('AppAdminBundle:rencontre:planing.html.twig', array(
                    'journee' => $journeematch,
                    'poule_id' => $id,
                    'journee' => $journee_array,
                    'court' => $court));
    }

    public function listjourneeAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $id_poule = $request->request->get('id');
        $journee = $request->request->get('journee');
        $match_journee = $em->getRepository('AppAdminBundle:Matchs')->getmatchjournee($id_poule, $journee);
        $response = new Response();
        $response->headers->set('NewslettresType', 'application/json');
        $response->setContent(json_encode($match_journee));
        return $response;
    }

    public function matchdetailAction(Request $request) {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getEntityManager();
        $match = $em->getRepository('AppAdminBundle:Matchs')->getmatchbyid($id);
        
        //equipe 1 tous les detail
        $equipe1 = $em->getRepository('AppAdminBundle:Equipe')->getEquipe($match['equipe1']);
        $equipe1detail = array();
        $doublet = array();
        foreach ($equipe1 as $k => $v) {
            if ($k > 0) {
                $doublet[$k - 1] = $v;
            }
        }
        $equipe1detail = array('id' => $equipe1[0]['id'], 'libelle' => $equipe1[0]['libelle'], 'doublet' => $doublet);

        //equipe 2 tous les detail
        $equipe2 = $em->getRepository('AppAdminBundle:Equipe')->getEquipe($match['equipe2']);
        $equipe2detail = array();
        $doublet = array();
        foreach ($equipe2 as $k => $v) {
            if ($k > 0) {
                $doublet[$k - 1] = $v;
            }
        }
        $equipe2detail = array('id' => $equipe2[0]['id'], 'libelle' => $equipe2[0]['libelle'], 'doublet' => $doublet);

        //tableau du match

        $detail_match = array(
            'equipe1' => $equipe1detail,
            'equipe2' => $equipe2detail,
            'match' => $id,
            'statut' => $match['statut']
        );

        $response = new Response();
        $response->headers->set('NewslettresType', 'application/json');
        $response->setContent(json_encode($detail_match));
        return $response;
    }

    public function newAction(Request $request) {
        $rencontre = new Rencontre();
        $form = $this->createForm(new \App\AdminBundle\Form\RencontreType(), $rencontre);

        return $this->render('AppAdminBundle:rencontre:new.html.twig', array('form' => $form->createView()));
    }

    public function ajouterAction(Request $request) {
        debug($request); 
        $em = $this->getDoctrine()->getEntityManager();
        $data = $request->request->get('rencontre');
        $rencontres = array();
        //debug($request);
        
        for ($i = 0; $i < count($data['doublet1']); $i++) {
            if(empty($data['poule_id'])){
                $poule = ' ';
            }else{
                $poule = $em->getRepository('AppAdminBundle:Poule')->findOneById($data['poule_id']);
            }
            $d = explode(' ', $data['date'][$i]);
            
            debug($data['date'][$i]);  
            $rencontres[$i] = array('doublet1' => $data['doublet1'][$i], 'doublet2' => $data['doublet2'][$i],
                'date' => $d[0],
                'time'=>$d[1],
                'court' => $data['court'][$i],
                'match' => $data['match'],
                'poule_id'=>$poule);
        }
        foreach ($rencontres as $k => $v) {
            $rencontre = new Rencontre();
            $rencontre->setCourt($v['court']);
            $rencontre->setDate($v['date']);
            $rencontre->setTime($v['time']);
            $doublet1 = $em->getRepository('AppAdminBundle:Doublet')->findOneById($v['doublet1']);
            $doublet2 = $em->getRepository('AppAdminBundle:Doublet')->findOneById($v['doublet2']);
            $rencontre->setDoublet1($doublet1);
            $rencontre->setDoublet2($doublet2);
            $matchs = $em->getRepository('AppAdminBundle:Matchs')->findOneById($v['match']);
            $rencontre->setMatchs($matchs);
            if(!empty($v['poule_id'])){
                $rencontre->setPoule($v['poule_id']);
            }
            $em->persist($rencontre);
            $em->flush();
        }
        $matchs = $em->getRepository('AppAdminBundle:Matchs')->findOneById($data['match']);
        $matchs->setStatut('1');
        $em->persist($matchs);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'Bien Enregister'));
        $referer = $this->getRequest()->headers->get('referer');

        return $this->redirect($referer);
    }

    public function matchdetaileditAction(Request $request) {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getEntityManager();
        $data = $em->getRepository('AppAdminBundle:Rencontre')->findrencontrebymatch($id);
        $match = $em->getRepository('AppAdminBundle:Matchs')->getmatchbyid($id);
        $array_data = array();
        $array_data = array('statut' => $match['statut'],
            'equipe1' => $match['equipe1'], 'equipe2' => $match['equipe2'], 'data' => $data);
        $response = new Response();
        $response->headers->set('NewslettresType', 'application/json');
        $response->setContent(json_encode($array_data));
        return $response;
    }

    public function testAction() {

        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppAdminBundle:Poule')->getEquipeexist();
        $equipe = $em->getRepository('AppAdminBundle:Equipe')->getall();
        $listequipe = array();

        //debug($data);

        foreach ($equipe as $k => $v) {
            foreach ($data as $kk => $vv) {
                
            }
        }
       // debug($listequipe);
        // debug($equipe);
        // debug($data); die;
        die;
        
    }

}

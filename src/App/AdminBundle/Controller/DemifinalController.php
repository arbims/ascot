<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Tournoi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Entity\Matchs;

class DemifinalController extends Controller {

    public function tournoi(Tournoi $tournoi) {
        $em = $this->getDoctrine()->getManager();
        $listpoule = $em->getRepository('AppAdminBundle:Poule')->getPoulebyIdtournoi($tournoi->getId());
        $classmentpoule = array();
        foreach ($listpoule as $k => $v) {
            $classment = $em->getRepository('AppAdminBundle:Result')->classment($v['id']);
            $classmentpoule[] = array('Poule' => $v['libelle'], 'classment' => $classment);
        }
        return $classmentpoule;
    }

    public function matchdemifinal($classmentpoule, $tournoi) {
        $data = array();
        foreach ($classmentpoule as $k => $v) {
            $data[$k] = array('equipe1' => $v['classment'][0], 'equipe2' => $v['classment'][1]);
        }
        $matchsdemifinal = [];
        $matchsdemifinal = array('match1' => array('equipe1' => $data[0]['equipe1'], 'equipe2' => $data[1]['equipe2']),
            'match2' => array('equipe1' => $data[1]['equipe1'], 'equipe2' => $data[0]['equipe2'])
        );
        return $matchsdemifinal;
    }

    public function Matchclassment($classmentpoule, $tournoi) {
        $em = $this->getDoctrine()->getManager();
        $tournoi = $em->getRepository('AppAdminBundle:Tournoi')->findOneById($tournoi);
        $data = [];
        $poule1 = $classmentpoule[0]['classment'];
        $poule2 = $classmentpoule[1]['classment'];
        $listmatch = [];
        foreach ($poule1 as $k => $v) {
            foreach ($poule2 as $kk => $vv) {
                if ($k == $kk && $k > 1) {
                    $listmatch[] = array('equipe1' => $v, 'equipe2' => $vv);
                }
            }
        }
        return $listmatch;
    }

    public function saveMatchdemifinalclassment(Request $request, $tournoi) {
        $classmentpoule  = $this->tournoi($tournoi);
        $matchclassment=$this->Matchclassment($classmentpoule, $tournoi);
        $matchdemifinal=$this->matchdemifinal($classmentpoule, $tournoi);
        $this->saveMatchclassment($matchclassment, $tournoi);
        $this->saveMatchdemifinal($matchdemifinal, $tournoi);
    }

    public function changestatutAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $tournoi = $em->getRepository('AppAdminBundle:Tournoi')->findOneById($request->request->get('id'));
        $this->saveMatchdemifinalclassment($request, $tournoi);
        $em = $this->getDoctrine()->getManager();
        $tournoi->setStatut(1);
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
    public function saveMatchdemifinal($listmatch, $tournoi) {
        $em = $this->getDoctrine()->getManager();
        $tournoi = $em->getRepository('AppAdminBundle:Tournoi')->findOneById($tournoi);
        foreach ($listmatch as $k => $vv) {
            $matchdemifinal = new Matchs();
            $matchdemifinal->setTournois($tournoi);
            $matchdemifinal->setEtapematch('demi_final');
            $matchdemifinal->setEquipe1($vv['equipe1']['equipe']);
            $matchdemifinal->setEquipe2($vv['equipe2']['equipe']);
            $em->persist($matchdemifinal);
            $em->flush();
        }
    }

    public function saveMatchclassment($listmatch, $tournoi) {
        $em = $this->getDoctrine()->getManager();
        $tournoi = $em->getRepository('AppAdminBundle:Tournoi')->findOneById($tournoi);
        foreach ($listmatch as $k => $vv) {
            $matchdemifinal = new Matchs();
            $matchdemifinal->setTournois($tournoi);
            $matchdemifinal->setEtapematch('classment');
            $matchdemifinal->setEquipe1($vv['equipe1']['equipe']);
            $matchdemifinal->setEquipe2($vv['equipe2']['equipe']);
            $em->persist($matchdemifinal);
            $em->flush();
        }
    }
    
    public function getfinalmatch()
    {
        $em = $this->getDoctrine()->getManager();
        $matchfinal = $em->getRepository('AppAdminBundle:Matchs')->getScorematchdemifinal($idtournoi);
        
    }
    
    

}

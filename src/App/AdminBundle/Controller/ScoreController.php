<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Score;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ScoreController extends Controller {

    /**
     * 
     * @param \App\AdminBundle\Controller\Request $request
     * Enregister le score
     */
    public function savescoreAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $referer = $request->headers->get('referer');
        $score = $request->request->get('rencontre')['score'];
        $data = [];

        $poule = $request->request->get('rencontre')['poule'];
        foreach ($score as $k => $v) {
            $rencontre = $em->getRepository('AppAdminBundle:Rencontre')->getrencontrebyId($v['id']);
            //debug($rencontre); die;
            //$matchs = $em->getRepository('AppAdminBundle:Matchs')->getmatchbyid($rencontre['matchs']['id']);
            $scorerencontre = explode('-', $v[0]);
            $data[$k] = array('rencontre' => $rencontre['id'],
                'idmatch' => $rencontre['matchs']['id'],
                'equipe1' => $rencontre['matchs']['equipe1'],
                'equipe2' => $rencontre['matchs']['equipe2'],
                'poule' => $rencontre['matchs']['poule'],
                'scoreequipe1' => $scorerencontre[0], 'scoreequipe2' => $scorerencontre[1]
            );
            //debug($matchs);
        }
        
        $match = $em->getRepository('AppAdminBundle:Matchs')->findOneById($data['match1']['idmatch']);
        $match->setTerminer('terminer');
        $em->persist($match);
        $em->flush();
        foreach ($data as $k => $v) {
            $equipe1 = $em->getRepository('AppAdminBundle:Equipe')->findOneByLibelle($v['equipe1']);
            $equipe2 = $em->getRepository('AppAdminBundle:Equipe')->findOneByLibelle($v['equipe2']);
            $poule = $em->getRepository('AppAdminBundle:Poule')->findOneById($v['poule']);
            $matchs = $em->getRepository('AppAdminBundle:Matchs')->findOneById($v['idmatch']);
            $resultscore = new Score();
            $resultscore->setIdRencontre($v['rencontre']);
            $resultscore->setPoule($poule);
            $resultscore->setIdEquipe1($equipe1);
            $resultscore->setIdEquipe2($equipe2);
            $resultscore->setImageEquipe1($equipe1->getPicture());
            $resultscore->setImageEquipe2($equipe2->getPicture());
            $resultscore->setFlagEquipe1($equipe1->getPicture2());
            $resultscore->setFlagequipe2($equipe2->getPicture2());
            $resultscore->setScoreEquipe1($v['scoreequipe1']);
            $resultscore->setScoreEquipe2($v['scoreequipe2']);
            $resultscore->setMatchId($matchs);
            $em->persist($resultscore);
            $em->flush();
        }
        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'le score bien ajouteé'));
        return $this->redirect($referer);
    }

    public function savescoreetape2Action(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $referer = $request->headers->get('referer');
        $score = $request->request->get('rencontre')['score'];
        $data = [];
       // debug($score);
        //$poule = $request->request->get('rencontre')['poule'];
        foreach ($score as $k => $v) {
            $rencontre = $em->getRepository('AppAdminBundle:Rencontre')->getrencontrebyId($v['id']);
            //debug($rencontre); die;
            //$matchs = $em->getRepository('AppAdminBundle:Matchs')->getmatchbyid($rencontre['matchs']['id']);
            $scorerencontre = explode('-', $v[0]);
            $data[$k] = array('rencontre' => $rencontre['id'],
                'idmatch' => $rencontre['matchs']['id'],
                'equipe1' => $rencontre['matchs']['equipe1'],
                'equipe2' => $rencontre['matchs']['equipe2'],
                //'poule' => $rencontre['matchs']['poule'],
                'scoreequipe1' => $scorerencontre[0], 'scoreequipe2' => $scorerencontre[1]
            );
            //debug($matchs);
        }
        $match = $em->getRepository('AppAdminBundle:Matchs')->findOneById($data['match1']['idmatch']);
        $match->setTerminer('terminer');
        $em->persist($match);
        $em->flush();
        foreach ($data as $k => $v) {
            //$poule = $em->getRepository('AppAdminBundle:Poule')->findOneById($v['poule']);
            $matchs = $em->getRepository('AppAdminBundle:Matchs')->findOneById($v['idmatch']);
            $resultscore = new Score();
            $resultscore->setIdRencontre($v['rencontre']);
            //$resultscore->setPoule($poule);
            $resultscore->setIdEquipe1($v['equipe1']);
            $resultscore->setIdEquipe2($v['equipe2']);
            $resultscore->setScoreEquipe1($v['scoreequipe1']);
            $resultscore->setScoreEquipe2($v['scoreequipe2']);
            $resultscore->setMatchId($matchs);
            $em->persist($resultscore);
            $em->flush();
        }
        $this->get('session')->getFlashBag()->add('notice', array('type' => 'success', 'message' => 'le score bien ajouteé'));
        return $this->redirect($referer);
    }


}

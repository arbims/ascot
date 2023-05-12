<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ResultController extends Controller {
    
    

    public function calculscoreAction($idpoule) {
        $em = $this->getDoctrine()->getManager();

        $result = $this->result($idpoule);

        $poule = $em->getRepository('AppAdminBundle:Poule')->findOneByid($idpoule);
        $dataresult = $em->getRepository('AppAdminBundle:Result')->findOneByPoule($idpoule);

        if (empty($dataresult)) {
            foreach ($result as $k => $v) {
                $resultat = new \App\AdminBundle\Entity\Result();
                $resultat->setLost($v['lost']);
                $resultat->setPoule($poule);
                $resultat->setWons($v['win']);
                $resultat->setEquipe($v['libelle']);
                $resultat->setResult($v['result']);
                $em->persist($resultat);
                $em->flush();
            }
        } else {
            foreach ($result as $k => $v) {
                $dataresult = $em->getRepository('AppAdminBundle:Result')->findOneByEquipe($k);
                $dataresult->setLost($v['lost']);
                $dataresult->setPoule($poule);
                $dataresult->setWons($v['win']);
                $dataresult->setEquipe($v['libelle']);
                $dataresult->setResult($v['result']);
                $em->persist($dataresult);
                $em->flush();
            }
        }
        $classment = $em->getRepository('AppAdminBundle:Result')->classment($idpoule);

        return $this->render('AppAdminBundle:result:calssment.html.twig', array('classment' => $classment));
    }

    public function matchwon($idpoule) {
        $em = $this->getDoctrine()->getManager();
        $equipe = $em->getRepository('AppAdminBundle:Poule')->getEquipebyidpoule($idpoule);

        $data = [];
        foreach ($equipe as $k => $v) {
            $win = 0;
            $lost = 0;
            $score = $em->getRepository('AppAdminBundle:Score')->getbyEquipe1($v['id']);
            $score2 = $em->getRepository('AppAdminBundle:Score')->getbyEquipe2($v['id']);
            foreach ($score as $kk => $vv) {
                if ($vv['scoreEquipe1'] == 1) {
                    $win = $win + 1;
                } else if ($vv['scoreEquipe1'] == 0) {
                    $lost = $lost + 1;
                }
            }
            foreach ($score2 as $kk => $vv) {
                if ($vv['scoreEquipe2'] == 1) {
                    $win = $win + 1;
                } else if ($vv['scoreEquipe2'] == 0) {
                    $lost = $lost + 1;
                }
            }
            $data[$v['libelle']] = array('libelle' => $v['libelle'], 'win' => $win, 'lost' => $lost);
        }
        return $data;
    }

    public function result($idpoule) {
        $em = $this->getDoctrine()->getManager();
        $win = $this->matchwon($idpoule);
        $result = [];
        $res = 0;
        foreach ($win as $k => $v) {
            $res = $v['win'] * 2 + $v['lost'] * 1;
            $result[$v['libelle']] = array('libelle' => $v['libelle'],
                'win' => $v['win'], 'lost' => $v['lost'],
                'result' => $res
            );
        }
        return $result;
    }
    
   
}

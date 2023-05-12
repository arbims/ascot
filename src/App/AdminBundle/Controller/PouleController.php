<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Journee;
use App\AdminBundle\Entity\Matchs;
use App\AdminBundle\Entity\Poule;
use App\AdminBundle\Form\EquipeType;
use App\AdminBundle\Form\PouleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Poule controller.
 *
 */
class PouleController extends Controller {

    /**
     * Lists all Poule entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $poules = $em->getRepository('AppAdminBundle:Poule')->findAll();

        return $this->render('AppAdminBundle:poule:index.html.twig', array(
                    'poules' => $poules,
        ));
    }

    /**
     * Creates a new Poule entity.
     *
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $poule = new Poule();
        $form = $this->createForm(new PouleType($em), $poule);
        $form->handleRequest($request);
        $formpoule = $this->createForm(new EquipeType($em));
        if ($form->isSubmitted() && $form->isValid()) {
            $listequipe = $request->request->get('poule')['equipelist'];
            $nombreequipe = count($listequipe);
            $poule = $form->getData();
            $poule->setNumberequipe($nombreequipe);
            foreach ($listequipe as $k => $v) {
                $equipe = $em->getRepository('AppAdminBundle:Equipe')->findOneById($v);
                $poule->addEquipe($equipe);
            }
            $em->persist($poule);
            $em->flush();

            return $this->redirectToRoute('poule_index');
        }

        return $this->render('AppAdminBundle:poule:new.html.twig', array(
                    'poule' => $poule,
                    'formpoule' => $formpoule->createView(),
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Poule entity.
     *
     */
    public function editAction(Request $request, Poule $poule) {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new PouleType($em), $poule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listequipe = $request->request->get('poule')['equipelist'];
            foreach ($listequipe as $k => $v) {
                $equipe = $em->getRepository('AppAdminBundle:Equipe')->findOneById($v);
                $poule->addEquipe($equipe);
            }
            $em->persist($poule);
            $em->flush();

            return $this->redirectToRoute('poule_index');
        }

        return $this->render('AppAdminBundle:poule:edit.html.twig', array(
                    'poule' => $poule,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a Poule entity.
     *
     */
    public function deleteAction(Poule $poule) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($poule);
        $em->flush();
        $match = $em->getRepository('AppAdminBundle:Matchs')->findByPoule($poule->getId());
        foreach ($match as $k => $v) {
            $em->remove($v);
            $em->flush();
        }
        return $this->redirectToRoute('poule_index');
    }

    public function getinfotournoisAction(Request $request, $id) {

        $em = $this->getDoctrine()->getEntityManager();

        $response = new Response();
        if ($request->isXmlHttpRequest()) {
            $listjoueur = $em->getRepository('AppAdminBundle:Tournoi')->gettournoi($id);
        }
        $response->setContent(json_encode($listjoueur));
        return $response;
    }

    public function generatematchAction($id) {
        $array = [];
        $listequipe = [];
        $listfinnal = [];
        $em = $this->getDoctrine()->getEntityManager();
        $poule_genrated = $em->getRepository('AppAdminBundle:Poule')->findOneById($id);
        $poule_genrated->setGenerated(true);
        $em->persist($poule_genrated);
        $em->flush();
        $poule = $em->getRepository('AppAdminBundle:Poule')->findPoulebyid($id);

        foreach ($poule['equipe'] as $k => $v) {
//$listequipe = array_merge($listequipe,$v['libelle']);
            $listequipe[] = $v['libelle'];
        }
        //debug($listequipe);
        $number_equipe = $poule['numberequipe'];
        
        if($number_equipe%2){
            $number_match = ($number_equipe % 2)+1;
            //debug($number_match);
            $number_equipe=$number_equipe+1;
            //echo'paire';
        }else{
            $number_match = $number_equipe / 2;
            //echo'ompaire';
        }
        $res = $this->affiche_tournoi($this->tournoi($number_match, $number_equipe));
        //debug($res);
        //die;
        //debug($res); 
        foreach ($res as $k => $v) {
            foreach ($v as $kk => $vv) {
                foreach ($vv as $key => $val) {
                    if(key_exists($val-1,$listequipe)){
                    $vv[$key] = $listequipe[$val-1];
                    //debug($vv);
                    }else{
                        $vv[$key] = 'notequipe';
                    }
                    
                }
                $v[$kk] = $vv;
            }
            $res[$k] = $v;
        }
        
        //debug($res); die;
        
        /*foreach ($res as $k => $v) {
            foreach ($v as $kk => $vv) {
                foreach ($vv as $key => $val) {
                    
                    $vv[$key] = $listequipe[$val - 1];
                }
                $v[$kk] = $vv;
            }
            $res[$k] = $v;
        }*/
        $this->saveMatch($res, $poule);
        return $this->redirectToRoute('poule_index');
    }

    /**
     * Retourne le tableau des entiers de $min à $max inclus
     * @param int $min
     * @param int $max
     * @return array of int
     * */
    function array_int($min, $max) {
        $res = array();
        for ($i = $min; $i <= $max; $i++) {
            $res[] = $i;
        }
        return $res;
    }

    /**
     * Calcule les rencontre de la journée numéro $journee dans le tournoi composé des équipe $equipes
     * @param array $equipes
     * @param array of array[2] (or null) $journee_precedente
     * @return array of array[2]
     * @return array of (array[2])
     * */
    function calcul_journee($equipes, $journee, $journee_precedente = null) {
        $rencontres = array();
        if ($journee_precedente) {
            // rotation des joueurs sans bouger le premier
            /* rotation dans le sens des aiguilles d'une montre (passage de $journee_precedente à $rencontres)
              A C E    --   A B C
              B D F    --   D F E
              $rencontres[$i][$j] =
             * si cas particulier (debordement)
             * 1* si $i = 0 et $j = 0 (place de A) alors $journee_precedente[0][0] (A ne change pas de place)
             * 2* si $i = 1 et $j = 0 (voisin de droite de A) alors $journee_precedente[0][1] (ancien adversaire de A)
             * 3* si $i = $dernier_i et $j = 1 (en bas à droite) alors $journee_precedente[$dernier_i][0]
             * sinon (cas générique)
             * 4* si $j = 0 alors $journee_precedente[$i-1][0]
             * 5* si $j = 1 alors $journee_precedente[$i+1][1]
              nb: les notions de "gauche" et "droite" sont celles de l'observateur extérieur, pas du joueur déplacé
             */
            $dernier_i = count($journee_precedente) - 1;
            // cas particuliers du $i = 0 (cas *1* et *5*)
            $rencontres[0] = array(/* 1 */ $journee_precedente[0][0], /* 5 */ $journee_precedente[1][1]);
            if ($dernier_i > 0) {
                // cas du $i=1 (cas *2* et (*5* ou *3*))
                $rencontres[1] = array(/* 2 */ $journee_precedente[0][1], $dernier_i == 1 ? /* 3 */ $journee_precedente[1][0] : /* 5 */ $journee_precedente[2][1]);
            }
            if ($dernier_i > 1) {
                // cas particulier *3* et cas général *4*
                // si $dernier_i <= 1 alors on a déjà traité ces cas précédemment
                $rencontres[$dernier_i] = array(/* 4 */ $journee_precedente[$dernier_i - 1][0], /* 3 */ $journee_precedente[$dernier_i][0]);
            }
            for ($i = 2; $i < $dernier_i; $i++) {
                // cas généraux *4* et *5*
                $rencontres[$i] = array(/* 4 */ $journee_precedente[$i - 1][0], /* 5 */ $journee_precedente[$i + 1][1]);
            }
        } else {
            // calcul de la premiere journee
            while (count($equipes) > 0) {
                $rencontres[] = array(array_shift($equipes), array_shift($equipes));
            }
        }
        return $rencontres;
    }

    /**
     * Calcule le tournoi (liste de journees)
     * @param int $nb_matchs_par_journee
     * @return array of array[2]
     * */
    function tournoi($nb_matchs_par_journee, $nb_equipes) {
        //$nb_equipes = 2 * $nb_matchs_par_journee;

        $equipes = $this->array_int(1, $nb_equipes);
        $journees = array();
        for ($journee = 1; $journee < $nb_equipes; $journee++) {
            $journees[$journee] = $this->calcul_journee($equipes, $journee, $journee == 1 ? null : $journees[$journee - 1]);
        }
        return $journees;
    }

    /**
     * Affiche le tournoi (ascii)
     * @param array of array of array[2]
     * */
    function affiche_tournoi($journees) {
        return $journees;
    }

    /**
     * enregister liste des match
     */
    public function saveMatch($res, $poule) {
        $em = $this->getDoctrine()->getEntityManager();
        foreach ($res as $k => $v) {
            foreach ($v as $kk => $vv) {
                $tournois = $em->getRepository('AppAdminBundle:Tournoi')->findOneById($poule['tournoi']['id']);
                $match = new Matchs();
                $match->setJournee($k);
                $match->setPoule($poule['id']);
                $match->setTournois($tournois);
                $match->setEtapematch('phase_de_poule');
                $match->setEquipe1($vv[0]);
                $match->setEquipe2($vv[1]);
                $em->persist($match);
                $em->flush();
                $journee = new Journee();
                $journee->setNumero($k);
                $journee->addIdMatch($match);
                $journee->setIdTournoi($tournois);
                $em->persist($journee);
                $em->flush();
            }
        }
    }
    
    
    public function listmatchpouleAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $listmatch = $em->getRepository('AppAdminBundle:Matchs')->findByPoule($id);


        return $this->render('AppAdminBundle:poule:listmatchpoule.html.twig',array('matchs'=>$listmatch));
    }

}

<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matchs
 *
 * @ORM\Table(name="matchs")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\MatchsRepository")
 */
class Matchs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Num", type="string", length=255, nullable=true)
     */
    private $num;

    /**
     * @var string
     *
     * @ORM\Column(name="Court", type="string", length=255, nullable=true)
     */
    private $court;


    /**
     *
     * @var type
     * @ORM\Column(name="Poule" , type="string" , length=255 , nullable=true)
     */
    private $poule;


    /**
     *
     * @var type
     * @ORM\Column(name="equipe1" , type="string" , length=255 , nullable=true)
     */
    private $equipe1;


    /**
     *
     * @var type
     * @ORM\Column(name="equipe2" , type="string" , length=255 , nullable=true)
     */
    private $equipe2;

    /**
     *
     * @var type
     * @ORM\Column(name="journee" , type="string", length=255 , nullable=true)
     */
    private $journee;

    /**
     * @var string
     * @ORM\Column(name="statut" , type="boolean" , nullable=true , options={"default" = false})
     */
    private $statut;

    /**
     * @var string
     * @ORM\Column(name="etapematch" , type="string" , length=255 , nullable=true)
     */
    private $etapematch;


    /**
     * @ORM\ManyToOne(targetEntity="Tournoi")
     * @ORM\JoinColumn(name="tournoi_id", referencedColumnName="id",  nullable=true)
     */
    private $tournois;

    /**
     *
     * @var string
     * @ORM\Column(name="terminer" , type="string" , length=255 , nullable=true)
     */
    private $terminer;


    /**
     *
     * @var string
     * @ORM\Column(name="score_eq1_match" , type="string" , length=255 , nullable=true)
     */
    private $score_eq1_match;

    /**
     *
     * @var string
     * @ORM\Column(name="score_eq2_match" , type="string" , length=255 , nullable=true)
     */
    private $score_eq2_match;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set num
     *
     * @param string $num
     *
     * @return Matchs
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return string
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set court
     *
     * @param string $court
     *
     * @return Matchs
     */
    public function setCourt($court)
    {
        $this->court = $court;

        return $this;
    }

    /**
     * Get court
     *
     * @return string
     */
    public function getCourt()
    {
        return $this->court;
    }

    /**
     * Set poule
     *
     * @param string $poule
     *
     * @return Matchs
     */
    public function setPoule($poule)
    {
        $this->poule = $poule;

        return $this;
    }

    /**
     * Get poule
     *
     * @return string
     */
    public function getPoule()
    {
        return $this->poule;
    }

    /**
     * Set equipe1
     *
     * @param string $equipe1
     * @return Matchs
     */
    public function setEquipe1($equipe1)
    {
        $this->equipe1 = $equipe1;

        return $this;
    }

    /**
     * Get equipe1
     *
     * @return string
     */
    public function getEquipe1()
    {
        return $this->equipe1;
    }

    /**
     * Set equipe2
     *
     * @param string $equipe2
     * @return Matchs
     */
    public function setEquipe2($equipe2)
    {
        $this->equipe2 = $equipe2;

        return $this;
    }

    /**
     * Get equipe2
     *
     * @return string
     */
    public function getEquipe2()
    {
        return $this->equipe2;
    }

    /**
     *
     * @param type $journee
     * @return \App\AdminBundle\Entity\Matchs
     */
    public function setJournee($journee)
    {
        $this->journee = $journee;
        return $this;
    }

    /**
     *
     * @return type
     */
    public function getJournee()
    {
        return $this->journee;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     * @return Matchs
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return boolean
     */
    public function getStatut()
    {
        return $this->statut;
    }


    /**
     * Set etapematch
     *
     * @param string $etapematch
     * @return Matchs
     */
    public function setEtapematch($etapematch)
    {
        $this->etapematch = $etapematch;

        return $this;
    }

    /**
     * Get etapematch
     *
     * @return string
     */
    public function getEtapematch()
    {
        return $this->etapematch;
    }

    /**
     * Set terminer
     *
     * @param string $terminer
     * @return Matchs
     */
    public function setTerminer($terminer)
    {
        $this->terminer = $terminer;

        return $this;
    }

    /**
     * Get terminer
     *
     * @return string
     */
    public function getTerminer()
    {
        return $this->terminer;
    }

    /**
     * Set tournois
     *
     * @param \App\AdminBundle\Entity\Tournoi $tournois
     * @return Matchs
     */
    public function setTournois(\App\AdminBundle\Entity\Tournoi $tournois = null)
    {
        $this->tournois = $tournois;

        return $this;
    }

    /**
     * Get tournois
     *
     * @return \App\AdminBundle\Entity\Tournoi
     */
    public function getTournois()
    {
        return $this->tournois;
    }

    /**
     * @return string
     */
    public function getScoreEq1Match()
    {
        return $this->score_eq1_match;
    }

    /**
     * @param string $score_eq1_match
     */
    public function setScoreEq1Match($score_eq1_match)
    {
        $this->score_eq1_match = $score_eq1_match;
        return $this;
    }

    /**
     * @return string
     */
    public function getScoreEq2Match()
    {
        return $this->score_eq2_match;
    }

    /**
     * @param string $score_eq2_match
     */
    public function setScoreEq2Match($score_eq2_match)
    {
        $this->score_eq2_match = $score_eq2_match;
        return $this;
    }


}

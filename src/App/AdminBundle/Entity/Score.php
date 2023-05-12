<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table(name="score")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\ScoreRepository")
 */
class Score
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
     * @ORM\Column(name="id_rencontre" , type="string" , length=255 , nullable=true)
     */
    private $idRencontre;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     */
    private $idEquipe1;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     */
    private $idEquipe2;

    /**
     * @var string
     *
     * @ORM\Column(name="score_equipe1", type="string", length=255)
     */
    private $scoreEquipe1;

    /**
     * @var string
     *
     * @ORM\Column(name="score_equipe2", type="string", length=255)
     */
    private $scoreEquipe2;

    /**
     * @ORM\ManyToOne(targetEntity="Matchs")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id")
     */
    private $match_id;
    
   
    /**
     *
     * @ORM\ManyToOne(targetEntity="Poule")
     * @ORM\JoinColumn(name="poule_id" , referencedColumnName="id")
     */
    private $poule;
    
    /**
     * @var string
     * @ORM\Column(name="imageequipe1", type="string" ,length=255 , nullable=true)
     */
    private $imageEquipe1;
    
    /**
     * @var string
     * @ORM\Column(name="imageequipe2", type="string" ,length=255, nullable=true)
     */
    private $imageEquipe2;
    
    /**
     *
     * @var string
     * @ORM\Column(name="flagequipe1" , type="string" , length=255 , nullable=true)
     */
    private $flagEquipe1;
    
    
    /**
     *
     * @var string
     * @ORM\Column(name="flagequipe2" , type="string" , length=255 , nullable=true)
     */
    private $flagequipe2;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idRencontre
     *
     * @param string $idRencontre
     * @return Score
     */
    public function setIdRencontre($idRencontre)
    {
        $this->idRencontre = $idRencontre;

        return $this;
    }

    /**
     * Get idRencontre
     *
     * @return string 
     */
    public function getIdRencontre()
    {
        return $this->idRencontre;
    }

    

    /**
     * Set scoreEquipe1
     *
     * @param string $scoreEquipe1
     * @return Score
     */
    public function setScoreEquipe1($scoreEquipe1)
    {
        $this->scoreEquipe1 = $scoreEquipe1;

        return $this;
    }

    /**
     * Get scoreEquipe1
     *
     * @return string 
     */
    public function getScoreEquipe1()
    {
        return $this->scoreEquipe1;
    }

    /**
     * Set scoreEquipe2
     *
     * @param string $scoreEquipe2
     * @return Score
     */
    public function setScoreEquipe2($scoreEquipe2)
    {
        $this->scoreEquipe2 = $scoreEquipe2;

        return $this;
    }

    /**
     * Get scoreEquipe2
     *
     * @return string 
     */
    public function getScoreEquipe2()
    {
        return $this->scoreEquipe2;
    }

    /**
     * Set match_id
     *
     * @param \App\AdminBundle\Entity\Matchs $matchId
     * @return Score
     */
    public function setMatchId(\App\AdminBundle\Entity\Matchs $matchId = null)
    {
        $this->match_id = $matchId;

        return $this;
    }

    /**
     * Get match_id
     *
     * @return \App\AdminBundle\Entity\Matchs 
     */
    public function getMatchId()
    {
        return $this->match_id;
    }
    
    /**
     * 
     * @param \App\AdminBundle\Entity\Poule $poule
     * @return \App\AdminBundle\Entity\Score
     */
    public function setPoule(\App\AdminBundle\Entity\Poule $poule = null)
    {
        $this->poule = $poule;
        return $this;
    }
    
    /**
     * 
     * @return type
     */
    public function getPoule()
    {
        return $this->poule;
    }

    /**
     * Set idEquipe1
     *
     * @param \App\AdminBundle\Entity\Equipe $idEquipe1
     * @return Score
     */
    public function setIdEquipe1(\App\AdminBundle\Entity\Equipe $idEquipe1 = null)
    {
        $this->idEquipe1 = $idEquipe1;

        return $this;
    }

    /**
     * Get idEquipe1
     *
     * @return \App\AdminBundle\Entity\Equipe 
     */
    public function getIdEquipe1()
    {
        return $this->idEquipe1;
    }

    /**
     * Set idEquipe2
     *
     * @param \App\AdminBundle\Entity\Equipe $idEquipe2
     * @return Score
     */
    public function setIdEquipe2(\App\AdminBundle\Entity\Equipe $idEquipe2 = null)
    {
        $this->idEquipe2 = $idEquipe2;

        return $this;
    }

    /**
     * Get idEquipe2
     *
     * @return \App\AdminBundle\Entity\Equipe 
     */
    public function getIdEquipe2()
    {
        return $this->idEquipe2;
    }

    /**
     * Set imageEquipe1
     *
     * @param string $imageEquipe1
     * @return Score
     */
    public function setImageEquipe1($imageEquipe1)
    {
        $this->imageEquipe1 = $imageEquipe1;

        return $this;
    }

    /**
     * Get imageEquipe1
     *
     * @return string 
     */
    public function getImageEquipe1()
    {
        return $this->imageEquipe1;
    }

    /**
     * Set imageEquipe2
     *
     * @param string $imageEquipe2
     * @return Score
     */
    public function setImageEquipe2($imageEquipe2)
    {
        $this->imageEquipe2 = $imageEquipe2;

        return $this;
    }

    /**
     * Get imageEquipe2
     *
     * @return string 
     */
    public function getImageEquipe2()
    {
        return $this->imageEquipe2;
    }

    /**
     * Set flagEquipe1
     *
     * @param string $flagEquipe1
     * @return Score
     */
    public function setFlagEquipe1($flagEquipe1)
    {
        $this->flagEquipe1 = $flagEquipe1;

        return $this;
    }

    /**
     * Get flagEquipe1
     *
     * @return string 
     */
    public function getFlagEquipe1()
    {
        return $this->flagEquipe1;
    }

    /**
     * Set flagequipe2
     *
     * @param string $flagequipe2
     * @return Score
     */
    public function setFlagequipe2($flagequipe2)
    {
        $this->flagequipe2 = $flagequipe2;

        return $this;
    }

    /**
     * Get flagequipe2
     *
     * @return string 
     */
    public function getFlagequipe2()
    {
        return $this->flagequipe2;
    }
}

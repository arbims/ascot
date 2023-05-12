<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rencontre
 *
 * @ORM\Table(name="rencontre")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\RencontreRepository")
 */
class Rencontre {

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
     * @ORM\Column(name="Journee", type="string", length=255, nullable=true)
     */
    private $journee;

    /**
     * @var string
     *
     * @ORM\Column(name="court", type="string", length=255, nullable=true)
     */
    private $court;

    /**
     * 
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Doublet")
     * @ORM\JoinColumn(name="doublet1_id", referencedColumnName="id")
     */
    private $doublet1;

    /**
     * @ORM\ManyToOne(targetEntity="Doublet")
     * @ORM\JoinColumn(name="doublet2_id", referencedColumnName="id")
     */
    private $doublet2;

    /**
     * @ORM\ManyToOne(targetEntity="Matchs")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id" , onDelete="cascade")
     */
    private $matchs;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Poule")
     * @ORM\JoinColumn(name="poule_id", referencedColumnName="id" , onDelete="cascade", nullable=true)
     */
    private $poule;
    
    /**
     *
     * @var string
     * @ORM\Column(name="time" , type="string" , length=255 , nullable=true)
     */
    private $time;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set journee
     *
     * @param string $journee
     *
     * @return Rencontre
     */
    public function setJournee($journee) {
        $this->journee = $journee;

        return $this;
    }

    /**
     * Get journee
     *
     * @return string
     */
    public function getJournee() {
        return $this->journee;
    }

    /**
     * Set court
     *
     * @param string $court
     * @return Rencontre
     */
    public function setCourt($court) {
        $this->court = $court;

        return $this;
    }

    /**
     * Get court
     *
     * @return string 
     */
    public function getCourt() {
        return $this->court;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Rencontre
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set doublet1
     *
     * @param \App\AdminBundle\Entity\Doublet $doublet1
     * @return Rencontre
     */
    public function setDoublet1(\App\AdminBundle\Entity\Doublet $doublet1 = null) {
        $this->doublet1 = $doublet1;

        return $this;
    }

    /**
     * Get doublet1
     *
     * @return \App\AdminBundle\Entity\Doublet 
     */
    public function getDoublet1() {
        return $this->doublet1;
    }

    /**
     * Set doublet2
     *
     * @param \App\AdminBundle\Entity\Doublet $doublet2
     * @return Rencontre
     */
    public function setDoublet2(\App\AdminBundle\Entity\Doublet $doublet2 = null) {
        $this->doublet2 = $doublet2;

        return $this;
    }

    /**
     * Get doublet2
     *
     * @return \App\AdminBundle\Entity\Doublet 
     */
    public function getDoublet2() {
        return $this->doublet2;
    }

    /**
     * Set matchs
     *
     * @param \App\AdminBundle\Entity\Matchs $matchs
     * @return Rencontre
     */
    public function setMatchs(\App\AdminBundle\Entity\Matchs $matchs = null) {
        $this->matchs = $matchs;

        return $this;
    }

    /**
     * Get poule
     *
     * @return \App\AdminBundle\Entity\Poule 
     */
    public function getPoule() {
        return $this->poule;
    }

    /*
     * Set Poule
     *
     * @param \App\AdminBundle\Entity\Matchs $matchs
     * @return Rencontre
     */

    public function setPoule(\App\AdminBundle\Entity\Poule $poule = null) {
        $this->poule = $poule;

        return $this;
    }

    /**
     * Get matchs
     *
     * @return \App\AdminBundle\Entity\Matchs 
     */
    public function getMatchs() {
        return $this->matchs;
    }
    
    /**
     * 
     * @param type $time
     * @return \App\AdminBundle\Entity\Rencontre
     */
    public function setTime($time){
        $this->time = $time;
        return $this;
    }
    
    /**
     * 
     * @return type
     */
    public function getTime(){
        return $this->time;
    }

}

<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * Tournoi
 *
 * @ORM\Table(name="tournoi")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\TournoiRepository")
 */
class Tournoi
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
     * @ORM\Column(name="Titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="datedebut", type="string", length=255, nullable=true)
     */
    private $datedebut;
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="datefin", type="string",length=255 , nullable=true)
     */
    private $datefin;


    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string",length=255 , nullable=true)
     */
    private $statut;
    
   

    
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Tournoi
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Tournoi
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

  

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     * @return Tournoi
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime 
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     * @return Tournoi
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime 
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set statut
     *
     * @param \DateTime $statut
     * @return Statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \Statut
     */
    public function getStatut()
    {
        return $this->statut;
    }
}

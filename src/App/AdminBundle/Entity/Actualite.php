<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actualite
 *
 * @ORM\Table(name="actualite")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\ActualiteRepository")
 */
class Actualite
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
     * @ORM\Column(name="Description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Date", type="string", length=255 , nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="Statut", type="boolean", nullable=true)
     */
    private $statut;
    
    /**
     * @ORM\ManyToOne(targetEntity="Journee")
     * @ORM\JoinColumn(name="journee_id", referencedColumnName="id")
     */
    private $journee;


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
     * @return Actualite
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
     * Set description
     *
     * @param string $description
     *
     * @return Actualite
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Actualite
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Actualite
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }
    




    /**
     * Set journee
     *
     * @param \App\AdminBundle\Entity\Journee $journee
     * @return Actualite
     */
    public function setJournee(\App\AdminBundle\Entity\Journee $journee = null)
    {
        $this->journee = $journee;

        return $this;
    }

    /**
     * Get journee
     *
     * @return \App\AdminBundle\Entity\Journee 
     */
    public function getJournee()
    {
        return $this->journee;
    }
}

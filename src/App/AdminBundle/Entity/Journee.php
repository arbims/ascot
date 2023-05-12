<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Journee
 *
 * @ORM\Table(name="journee")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\JourneeRepository")
 */
class Journee {

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
     * @ORM\Column(name="numero", type="string", length=255, nullable=true)
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity="Tournoi")
     * @ORM\JoinColumn(name="tournoi_id", referencedColumnName="id")
     */
    private $id_tournoi;

    /**
     * @ORM\ManyToMany(targetEntity="Matchs")
     * @ORM\JoinTable(name="match_journee",
     *      joinColumns={@ORM\JoinColumn(name="journee_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="match_id", referencedColumnName="id")}
     *      )
     */
    private $id_matchs;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return Journee
     */
    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero() {
        return $this->numero;
    }
    /**
     * 
     * @return type
     */
    function getId_tournoi() {
        return $this->id_tournoi;
    }
    
    /**
     * 
     * @param type $id_tournoi
     * @return \App\AdminBundle\Entity\Journee
     */
    function setId_tournoi($id_tournoi) {
        $this->id_tournoi = $id_tournoi;
        return $this;
    }
    
    /**
     * 
     * @return type
     */
    function getId_matchs() {
        return $this->id_matchs;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id_matchs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id_tournoi
     *
     * @param \App\AdminBundle\Entity\Tournoi $idTournoi
     * @return Journee
     */
    public function setIdTournoi(\App\AdminBundle\Entity\Tournoi $idTournoi = null)
    {
        $this->id_tournoi = $idTournoi;

        return $this;
    }

    /**
     * Get id_tournoi
     *
     * @return \App\AdminBundle\Entity\Tournoi 
     */
    public function getIdTournoi()
    {
        return $this->id_tournoi;
    }

    /**
     * Add id_matchs
     *
     * @param \App\AdminBundle\Entity\Matchs $idMatchs
     * @return Journee
     */
    public function addIdMatch(\App\AdminBundle\Entity\Matchs $idMatchs)
    {
        $this->id_matchs[] = $idMatchs;

        return $this;
    }

    /**
     * Remove id_matchs
     *
     * @param \App\AdminBundle\Entity\Matchs $idMatchs
     */
    public function removeIdMatch(\App\AdminBundle\Entity\Matchs $idMatchs)
    {
        $this->id_matchs->removeElement($idMatchs);
    }

    /**
     * Get id_matchs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdMatchs()
    {
        return $this->id_matchs;
    }
}

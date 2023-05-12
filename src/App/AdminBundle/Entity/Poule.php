<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Poule
 *
 * @ORM\Table(name="poule")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\PouleRepository")
 */
class Poule
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
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;
    /**
     * @ORM\ManyToMany(targetEntity="Equipe")
     * @ORM\JoinTable(name="poule_equipe",
     *      joinColumns={@ORM\JoinColumn(name="poule_id", referencedColumnName="id",onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="equipe_id", referencedColumnName="id", unique=true, onDelete="CASCADE")}
     *      )
     */
    private $equipe;
    
    /**
     *
     * @var decimal
     * @ORM\Column(name="numberequipe" , type="decimal" )
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $numberequipe;
    
    
    /**
     *
     * @var type 
     * @ORM\ManyToOne(targetEntity="Tournoi")
     */
    private $tournoi;
    
    
    /**
     *
     * @ORM\Column(name="generated", type="boolean", nullable=true , options={"default" = false})
     */
    private $generated;

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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Poule
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipe = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add equipe
     *
     * @param \App\AdminBundle\Entity\Equipe $equipe
     *
     * @return Poule
     */
    public function addEquipe(\App\AdminBundle\Entity\Equipe $equipe)
    {
        $this->equipe[] = $equipe;

        return $this;
    }

    /**
     * Remove equipe
     *
     * @param \App\AdminBundle\Entity\Equipe $equipe
     */
    public function removeEquipe(\App\AdminBundle\Entity\Equipe $equipe)
    {
        $this->equipe->removeElement($equipe);
    }

    /**
     * Get equipes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipe()
    {
        return $this->equipe;
    }

    /**
     * Set numberequipe
     *
     * @param string $numberequipe
     * @return Poule
     */
    public function setNumberequipe($numberequipe)
    {
        $this->numberequipe = $numberequipe;

        return $this;
    }

    /**
     * Get numberequipe
     *
     * @return string 
     */
    public function getNumberequipe()
    {
        return $this->numberequipe;
    }

    /**
     * Set tournoi
     *
     * @param \App\AdminBundle\Entity\Tournoi $tournoi
     * @return Poule
     */
    public function setTournoi(\App\AdminBundle\Entity\Tournoi $tournoi = null)
    {
        $this->tournoi = $tournoi;

        return $this;
    }

    /**
     * Get tournoi
     *
     * @return \App\AdminBundle\Entity\Tournoi 
     */
    public function getTournoi()
    {
        return $this->tournoi;
    }

    /**
     * Set generated
     *
     * @param boolean $generated
     * @return Poule
     */
    public function setGenerated($generated)
    {
        $this->generated = $generated;

        return $this;
    }

    /**
     * Get generated
     *
     * @return boolean 
     */
    public function getGenerated()
    {
        return $this->generated;
    }
}

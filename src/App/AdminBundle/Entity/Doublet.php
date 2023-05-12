<?php

namespace App\AdminBundle\Entity;

use App\AdminBundle\Repository\DoubletRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Doublet
 *
 * @ORM\Table(name="doublet")
 * @ORM\Entity(repositoryClass="DoubletRepository")
 */
class Doublet
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
     * @ORM\Column(name="Libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\UserBundle\Entity\Joueur", mappedBy="doublet")
     */
    private $joueurs;

    /**
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumn(name="equipe_id", referencedColumnName="id")
     */
    private $equipe;
    
    
    
    public function __construct() {
        $this->joueurs = new ArrayCollection();
    }

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
     * @return Doublet
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
     * Set equipe
     *
     * @param Equipe $equipe
     *
     * @return Doublet
     */
    public function setEquipe(Equipe $equipe = null)
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return Equipe
     */
    public function getEquipe()
    {
        return $this->equipe;
    }



    /**
     * Add joueurs
     *
     * @param \App\UserBundle\Entity\Joueur $joueurs
     * @return Doublet
     */
    public function addJoueur(\App\UserBundle\Entity\Joueur $joueurs)
    {
        $this->joueurs[] = $joueurs;

        return $this;
    }

    /**
     * Remove joueurs
     *
     * @param \App\UserBundle\Entity\Joueur $joueurs
     */
    public function removeJoueur(\App\UserBundle\Entity\Joueur $joueurs)
    {
        $this->joueurs->removeElement($joueurs);
    }

    /**
     * Get joueurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJoueurs()
    {
        return $this->joueurs;
    }
}

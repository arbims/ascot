<?php

namespace App\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Espaceuser
 *
 * @ORM\Table(name="compteadmin")
 * @ORM\Entity(repositoryClass="App\UserBundle\Repository\CompteAdminRepository")
 */
class CompteAdmin
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
    * @ORM\OneToOne(targetEntity="App\UserBundle\Entity\User")
    * @ORM\JoinColumn(name="idcompte", referencedColumnName="id" , onDelete="cascade")
    */
    private $idcompte;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string" , length=255 , nullable= true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="numtel", type="string" , length=255 , nullable= true)
     */
    private $numtel;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string" , length=255 , nullable= true)
     */
    private $adresse;



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
     * Set nom
     *
     * @param string $nom
     *
     * @return CompteAdmin
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return CompteAdmin
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set numtel
     *
     * @param string $numtel
     *
     * @return CompteAdmin
     */
    public function setNumtel($numtel)
    {
        $this->numtel = $numtel;

        return $this;
    }

    /**
     * Get numtel
     *
     * @return string
     */
    public function getNumtel()
    {
        return $this->numtel;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return CompteAdmin
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set idcompte
     *
     * @param \App\UserBundle\Entity\User $idcompte
     *
     * @return CompteAdmin
     */
    public function setIdcompte(\App\UserBundle\Entity\User $idcompte = null)
    {
        $this->idcompte = $idcompte;

        return $this;
    }

    /**
     * Get idcompte
     *
     * @return \App\UserBundle\Entity\User
     */
    public function getIdcompte()
    {
        return $this->idcompte;
    }
}

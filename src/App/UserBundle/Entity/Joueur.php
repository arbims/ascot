<?php

namespace App\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Joueur
 *
 * @ORM\Table(name="joueur")
 * @ORM\Entity(repositoryClass="App\UserBundle\Repository\JoueurRepository")
 */
class Joueur {

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
     * @ORM\Column(name="NomPrenom", type="string", length=255, nullable=true)
     */
    private $nomPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Sexe", type="string", length=255, nullable=true)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="Tel", type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Pays", type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\Equipe")
     * @ORM\JoinColumn(name="equipe_id", referencedColumnName="id")
     */
    private $equipe;

    /**
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\Doublet", inversedBy="joueurs")
     * @ORM\JoinColumn(name="doublet_id", referencedColumnName="id", onDelete="cascade")
     */
    private $doublet;

    /**
     * @ORM\OneToOne(targetEntity="App\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idcompte", referencedColumnName="id")
     */
    private $idcompte;

    /**
     * @var string
     *
     * @ORM\Column(name="capitaine", type="boolean", nullable=true)
     */
    private $capitaine;

    /**
     * @var string
     * @ORM\Column(name="picture2" , type="string" , length=255 , nullable=true )
     */
    private $picture2;

    /**
     * @var string
     * @ORM\Column(name="societe" , type="string" , length=255 , nullable=true)
     */
    private $societe;

    /**
     * @var string
     * @ORM\Column(name="fonction" , type="string" , length=255 , nullable=true )
     */
    private $fonction;

    /**
     * @var string
     * @ORM\Column(name="membre" , type="string" , length=255 , nullable=true)
    */
    private $membre;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nomPrenom
     *
     * @param string $nomPrenom
     * @return Joueur
     */
    public function setNomPrenom($nomPrenom) {
        $this->nomPrenom = $nomPrenom;

        return $this;
    }

    /**
     * Get nomPrenom
     *
     * @return string 
     */
    public function getNomPrenom() {
        return $this->nomPrenom;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Joueur
     */
    public function setSexe($sexe) {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe() {
        return $this->sexe;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Joueur
     */
    public function setTel($tel) {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel() {
        return $this->tel;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Joueur
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return Joueur
     */
    public function setPays($pays) {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays() {
        return $this->pays;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Joueur
     */
    public function setVille($ville) {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille() {
        return $this->ville;
    }

    /**
     * Set equipe
     *
     * @param \App\AdminBundle\Entity\Equipe $equipe
     * @return Joueur
     */
    public function setEquipe(\App\AdminBundle\Entity\Equipe $equipe = null) {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return \App\AdminBundle\Entity\Equipe 
     */
    public function getEquipe() {
        return $this->equipe;
    }

    /**
     * Set doublet
     *
     * @param \App\AdminBundle\Entity\Doublet $doublet
     * @return Joueur
     */
    public function setDoublet(\App\AdminBundle\Entity\Doublet $doublet = null) {
        $this->doublet = $doublet;

        return $this;
    }

    /**
     * Get doublet
     *
     * @return \App\AdminBundle\Entity\Doublet 
     */
    public function getDoublet() {
        return $this->doublet;
    }

    /**
     * Set idcompte
     *
     * @param \App\UserBundle\Entity\User $idcompte
     * @return Joueur
     */
    public function setIdcompte(\App\UserBundle\Entity\User $idcompte = null) {
        $this->idcompte = $idcompte;

        return $this;
    }

    /**
     * Get idcompte
     *
     * @return \App\UserBundle\Entity\User 
     */
    public function getIdcompte() {
        return $this->idcompte;
    }


    /**
     * Set capitane
     *
     * @param boolean $capitane
     * @return Joueur
     */
    public function setCapitaine($capitaine)
    {
        $this->capitaine = $capitaine;

        return $this;
    }

    /**
     * Get capitane
     *
     * @return boolean 
     */
    public function getCapitaine()
    {
        return $this->capitaine;
    }

    /**
     * Set picture2
     *
     * @param string $picture2
     * @return Joueur
     */
    public function setPicture2($picture2)
    {
        $this->picture2 = $picture2;

        return $this;
    }

    /**
     * Get picture2
     *
     * @return string 
     */
    public function getPicture2()
    {
        return $this->picture2;
    }

    /**
     * Set societe
     *
     * @param string $societe
     * @return Joueur
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return string 
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     * @return Joueur
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string 
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set fonction
     *
     * @param string $membre
     * @return Joueur
     */
    public function setMembre($membre)
    {
        $this->membre = $membre;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string 
     */
    public function getMembre()
    {
        return $this->membre;
    }
}

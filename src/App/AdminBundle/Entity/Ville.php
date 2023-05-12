<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville", indexes={@ORM\Index(name="city_slug", columns={"city_slug"}), @ORM\Index(name="cp", columns={"cp"}), @ORM\Index(name="id_departement", columns={"id_departement"})})
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\VilleRepository")
 */
class Ville {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ville", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVille;

    /**
     * @var string
     *
     * @ORM\Column(name="id_departement", type="string", length=5,  nullable=true)
     */
    private $idDepartement;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_ville_uppercase", type="string", length=255, nullable=true)
     */
    private $nomVilleUppercase;

    /**
     * @var string
     *
     * @ORM\Column(name="city_slug", type="string", length=255, nullable=true)
     */
    private $citySlug;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255, nullable=true)
     */
    private $cp;

    /**
     *
     * @var string
     * @ORM\Column(name="pays_id" , type="string" , length=255 , nullable=true)
     */
    private $pays_id;

    /**
     * Get idVille
     *
     * @return integer 
     */
    public function getIdVille() {
        return $this->idVille;
    }

    /**
     * Set idDepartement
     *
     * @param string $idDepartement
     * @return Ville
     */
    public function setIdDepartement($idDepartement) {
        $this->idDepartement = $idDepartement;

        return $this;
    }

    /**
     * Get idDepartement
     *
     * @return string 
     */
    public function getIdDepartement() {
        return $this->idDepartement;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Ville
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set nomVilleUppercase
     *
     * @param string $nomVilleUppercase
     * @return Ville
     */
    public function setNomVilleUppercase($nomVilleUppercase) {
        $this->nomVilleUppercase = $nomVilleUppercase;

        return $this;
    }

    /**
     * Get nomVilleUppercase
     *
     * @return string 
     */
    public function getNomVilleUppercase() {
        return $this->nomVilleUppercase;
    }

    /**
     * Set citySlug
     *
     * @param string $citySlug
     * @return Ville
     */
    public function setCitySlug($citySlug) {
        $this->citySlug = $citySlug;

        return $this;
    }

    /**
     * Get citySlug
     *
     * @return string 
     */
    public function getCitySlug() {
        return $this->citySlug;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return Ville
     */
    public function setCp($cp) {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp() {
        return $this->cp;
    }
    
    /**
     * 
     * @return type
     */
    function getPays_id() {
        return $this->pays_id;
    }
    
    /**
     * 
     * @param type $pays_id
     */
    function setPays_id($pays_id) {
        $this->pays_id = $pays_id;
        return $this;
    }


    /**
     * Set pays_id
     *
     * @param string $paysId
     * @return Ville
     */
    public function setPaysId($paysId)
    {
        $this->pays_id = $paysId;

        return $this;
    }

    /**
     * Get pays_id
     *
     * @return string 
     */
    public function getPaysId()
    {
        return $this->pays_id;
    }
}

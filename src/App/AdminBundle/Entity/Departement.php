<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departement
 *
 * @ORM\Table(name="departement", indexes={@ORM\Index(name="departement_slug", columns={"departement_slug"}), @ORM\Index(name="id_region", columns={"id_region"})})
 * @ORM\Entity
 */
class Departement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_departement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDepartement;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_region", type="integer", nullable=false)
     */
    private $idRegion;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=3, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name_departement", type="string", length=250, nullable=false)
     */
    private $nameDepartement;

    /**
     * @var string
     *
     * @ORM\Column(name="name_departement_uppercase", type="string", length=255, nullable=true)
     */
    private $nameDepartementUppercase;

    /**
     * @var string
     *
     * @ORM\Column(name="departement_slug", type="string", length=255, nullable=false)
     */
    private $departementSlug;



    /**
     * Get idDepartement
     *
     * @return integer 
     */
    public function getIdDepartement()
    {
        return $this->idDepartement;
    }

    /**
     * Set idRegion
     *
     * @param integer $idRegion
     * @return Departement
     */
    public function setIdRegion($idRegion)
    {
        $this->idRegion = $idRegion;

        return $this;
    }

    /**
     * Get idRegion
     *
     * @return integer 
     */
    public function getIdRegion()
    {
        return $this->idRegion;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Departement
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nameDepartement
     *
     * @param string $nameDepartement
     * @return Departement
     */
    public function setNameDepartement($nameDepartement)
    {
        $this->nameDepartement = $nameDepartement;

        return $this;
    }

    /**
     * Get nameDepartement
     *
     * @return string 
     */
    public function getNameDepartement()
    {
        return $this->nameDepartement;
    }

    /**
     * Set nameDepartementUppercase
     *
     * @param string $nameDepartementUppercase
     * @return Departement
     */
    public function setNameDepartementUppercase($nameDepartementUppercase)
    {
        $this->nameDepartementUppercase = $nameDepartementUppercase;

        return $this;
    }

    /**
     * Get nameDepartementUppercase
     *
     * @return string 
     */
    public function getNameDepartementUppercase()
    {
        return $this->nameDepartementUppercase;
    }

    /**
     * Set departementSlug
     *
     * @param string $departementSlug
     * @return Departement
     */
    public function setDepartementSlug($departementSlug)
    {
        $this->departementSlug = $departementSlug;

        return $this;
    }

    /**
     * Get departementSlug
     *
     * @return string 
     */
    public function getDepartementSlug()
    {
        return $this->departementSlug;
    }
}

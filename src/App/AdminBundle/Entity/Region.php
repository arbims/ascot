<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region", indexes={@ORM\Index(name="region_slug", columns={"region_slug"}), @ORM\Index(name="id_pays", columns={"id_pays"})})
 * @ORM\Entity
 */
class Region
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_region", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRegion;

    /**
     * @var string
     *
     * @ORM\Column(name="name_region", type="string", length=250, nullable=false)
     */
    private $nameRegion;

    /**
     * @var string
     *
     * @ORM\Column(name="name_region_uppercase", type="string", length=255, nullable=true)
     */
    private $nameRegionUppercase;

    /**
     * @var string
     *
     * @ORM\Column(name="region_slug", type="string", length=255, nullable=false)
     */
    private $regionSlug;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_pays", type="integer", nullable=false)
     */
    private $idPays;



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
     * Set nameRegion
     *
     * @param string $nameRegion
     * @return Region
     */
    public function setNameRegion($nameRegion)
    {
        $this->nameRegion = $nameRegion;

        return $this;
    }

    /**
     * Get nameRegion
     *
     * @return string 
     */
    public function getNameRegion()
    {
        return $this->nameRegion;
    }

    /**
     * Set nameRegionUppercase
     *
     * @param string $nameRegionUppercase
     * @return Region
     */
    public function setNameRegionUppercase($nameRegionUppercase)
    {
        $this->nameRegionUppercase = $nameRegionUppercase;

        return $this;
    }

    /**
     * Get nameRegionUppercase
     *
     * @return string 
     */
    public function getNameRegionUppercase()
    {
        return $this->nameRegionUppercase;
    }

    /**
     * Set regionSlug
     *
     * @param string $regionSlug
     * @return Region
     */
    public function setRegionSlug($regionSlug)
    {
        $this->regionSlug = $regionSlug;

        return $this;
    }

    /**
     * Get regionSlug
     *
     * @return string 
     */
    public function getRegionSlug()
    {
        return $this->regionSlug;
    }

    /**
     * Set idPays
     *
     * @param integer $idPays
     * @return Region
     */
    public function setIdPays($idPays)
    {
        $this->idPays = $idPays;

        return $this;
    }

    /**
     * Get idPays
     *
     * @return integer 
     */
    public function getIdPays()
    {
        return $this->idPays;
    }
}

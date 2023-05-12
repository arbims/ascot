<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays", indexes={@ORM\Index(name="pays_slug", columns={"pays_slug"})})
 * @ORM\Entity
 */
class Pays
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name_pays", type="string", length=80, nullable=false)
     */
    private $namePays;

    /**
     * @var string
     *
     * @ORM\Column(name="name_pays_uppercase", type="string", length=255, nullable=true)
     */
    private $namePaysUppercase;

    /**
     * @var string
     *
     * @ORM\Column(name="pays_slug", type="string", length=255, nullable=true)
     */
    private $paysSlug;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=2, nullable=true)
     */
    private $code;



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
     * Set namePays
     *
     * @param string $namePays
     * @return Pays
     */
    public function setNamePays($namePays)
    {
        $this->namePays = $namePays;

        return $this;
    }

    /**
     * Get namePays
     *
     * @return string 
     */
    public function getNamePays()
    {
        return $this->namePays;
    }

    /**
     * Set namePaysUppercase
     *
     * @param string $namePaysUppercase
     * @return Pays
     */
    public function setNamePaysUppercase($namePaysUppercase)
    {
        $this->namePaysUppercase = $namePaysUppercase;

        return $this;
    }

    /**
     * Get namePaysUppercase
     *
     * @return string 
     */
    public function getNamePaysUppercase()
    {
        return $this->namePaysUppercase;
    }

    /**
     * Set paysSlug
     *
     * @param string $paysSlug
     * @return Pays
     */
    public function setPaysSlug($paysSlug)
    {
        $this->paysSlug = $paysSlug;

        return $this;
    }

    /**
     * Get paysSlug
     *
     * @return string 
     */
    public function getPaysSlug()
    {
        return $this->paysSlug;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Pays
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
}

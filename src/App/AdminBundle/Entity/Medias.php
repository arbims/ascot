<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medias
 *
 * @ORM\Table(name="medias")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\MediasRepository")
 */
class Medias
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var type
     * @ORM\ManyToOne(targetEntity="App\AdminBundle\Entity\Actualite")
     * @ORM\JoinColumn(name="actualite_id", referencedColumnName="id" , onDelete="CASCADE")
     */
    private $actualite;

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
     * Set name
     *
     * @param string $name
     * @return Medias
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Medias
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set actualite
     *
     * @param \App\AdminBundle\Entity\Actualite $actualite
     * @return Medias
     */
    public function setActualite(\App\AdminBundle\Entity\Actualite $actualite = null)
    {
        $this->actualite = $actualite;

        return $this;
    }

    /**
     * Get actualite
     *
     * @return \App\AdminBundle\Entity\Actualite 
     */
    public function getActualite()
    {
        return $this->actualite;
    }
}

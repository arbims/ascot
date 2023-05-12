<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Result
 *
 * @ORM\Table(name="result")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\ResultRepository")
 */
class Result
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
     * @ORM\Column(name="result", type="string", length=255, nullable=true)
     */
    private $result;

    /**
     * @var string
     *
     * @ORM\Column(name="wons", type="string", length=255, nullable=true)
     */
    private $wons;

    /**
     * @var string
     *
     * @ORM\Column(name="lost", type="string", length=255, nullable=true)
     */
    private $lost;

    /**
     * @ORM\ManyToOne(targetEntity="Poule")
     * @ORM\JoinColumn(name="poule_id", referencedColumnName="id")
     */
    private $poule;
    
    /**
     * @var string
     * @ORM\Column(name="equipe", type="string", length=255, nullable=true)
     */
    private  $equipe;
    
    

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
     * Set result
     *
     * @param string $result
     * @return Result
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return string 
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set wons
     *
     * @param string $wons
     * @return Result
     */
    public function setWons($wons)
    {
        $this->wons = $wons;

        return $this;
    }

    /**
     * Get wons
     *
     * @return string 
     */
    public function getWons()
    {
        return $this->wons;
    }

    /**
     * Set lost
     *
     * @param string $lost
     * @return Result
     */
    public function setLost($lost)
    {
        $this->lost = $lost;

        return $this;
    }

    /**
     * Get lost
     *
     * @return string 
     */
    public function getLost()
    {
        return $this->lost;
    }

    /**
     * Set poule
     *
     * @param \App\AdminBundle\Entity\Poule $poule
     * @return Result
     */
    public function setPoule(\App\AdminBundle\Entity\Poule $poule = null)
    {
        $this->poule = $poule;

        return $this;
    }

    /**
     * Get poule
     *
     * @return \App\AdminBundle\Entity\Poule 
     */
    public function getPoule()
    {
        return $this->poule;
    }

    /**
     * Set equipe
     *
     * @param string $equipe
     * @return Result
     */
    public function setEquipe($equipe)
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return string 
     */
    public function getEquipe()
    {
        return $this->equipe;
    }
}

<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\NotificationRepository")
 */
class Notification
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
     * @ORM\Column(name="Vue", type="string", length=255, nullable=true)
     */
    private $vue;

    /**
     * @var string
     *
     * @ORM\Column(name="Lien", type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="Id_emetteur", type="string", length=255, nullable=true)
     */
    private $idEmetteur;

    /**
     * @var string
     *
     * @ORM\Column(name="Id_type_notif", type="string", length=255, nullable=true)
     */
    private $idTypeNotif;


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
     * Set vue
     *
     * @param string $vue
     *
     * @return Notification
     */
    public function setVue($vue)
    {
        $this->vue = $vue;

        return $this;
    }

    /**
     * Get vue
     *
     * @return string
     */
    public function getVue()
    {
        return $this->vue;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Notification
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set idEmetteur
     *
     * @param string $idEmetteur
     *
     * @return Notification
     */
    public function setIdEmetteur($idEmetteur)
    {
        $this->idEmetteur = $idEmetteur;

        return $this;
    }

    /**
     * Get idEmetteur
     *
     * @return string
     */
    public function getIdEmetteur()
    {
        return $this->idEmetteur;
    }

    /**
     * Set idTypeNotif
     *
     * @param string $idTypeNotif
     *
     * @return Notification
     */
    public function setIdTypeNotif($idTypeNotif)
    {
        $this->idTypeNotif = $idTypeNotif;

        return $this;
    }

    /**
     * Get idTypeNotif
     *
     * @return string
     */
    public function getIdTypeNotif()
    {
        return $this->idTypeNotif;
    }
}

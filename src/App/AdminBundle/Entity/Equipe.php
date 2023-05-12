<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Equipe
 *
 * @ORM\Table(name="equipe")
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\EquipeRepository")
 */
class Equipe
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
     * @ORM\Column(name="Libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="Nbrjoueur", type="string", length=255, nullable=true)
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $nbrjoueur;

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
     * @var string
     *
     * @ORM\Column(name="Website", type="text")
     * @Assert\Url()
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="Mail", type="text")
     * @Assert\Email(
     *     message = "invalide email '{{ value }}' .",
     *     checkMX = true
     * )
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="Tel", type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @var string
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @var string
     * @ORM\Column(name="picture2", type="string", length=255, nullable=true)
     */
    private $picture2;



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
     * @return Equipe
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
     * Set nbrjoueur
     *
     * @param string $nbrjoueur
     *
     * @return Equipe
     */
    public function setNbrjoueur($nbrjoueur)
    {
        $this->nbrjoueur = $nbrjoueur;

        return $this;
    }

    /**
     * Get nbrjoueur
     *
     * @return string
     */
    public function getNbrjoueur()
    {
        return $this->nbrjoueur;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Equipe
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
     * Set pays
     *
     * @param string $pays
     *
     * @return Equipe
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Equipe
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Equipe
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Equipe
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Equipe
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }



    /**
     * Set picture
     *
     * @param string $picture
     * @return Equipe
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set picture2
     *
     * @param string $picture2
     * @return Equipe
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
}

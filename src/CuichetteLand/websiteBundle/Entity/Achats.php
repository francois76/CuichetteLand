<?php

namespace CuichetteLand\websiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Achats
 *
 * @ORM\Table(name="achats")
 * @ORM\Entity(repositoryClass="CuichetteLand\websiteBundle\Repository\AchatsRepository")
 */
class Achats
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
     * @var int
     *
     * @ORM\Column(name="utilisateur", type="integer")
     */
    private $utilisateur;

	/**
     * @var int
     *
     * @ORM\Column(name="idarticle", type="integer")
     */
	private $idarticle;
	
    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var bool
     *
     * @ORM\Column(name="valide", type="boolean")
     */
    private $valide;


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
     * Set utilisateur
     *
     * @param integer $utilisateur
     *
     * @return Achats
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return int
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Achats
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     *
     * @return Achats
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return bool
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set idarticle
     *
     * @param integer $idarticle
     *
     * @return Achats
     */
    public function setIdarticle($idarticle)
    {
        $this->idarticle = $idarticle;

        return $this;
    }

    /**
     * Get idarticle
     *
     * @return integer
     */
    public function getIdarticle()
    {
        return $this->idarticle;
    }
}

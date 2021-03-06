<?php

namespace CuichetteLand\websiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="CuichetteLand\websiteBundle\Repository\ImagesRepository")
 */
class Images
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
     * @ORM\Column(name="id_produit", type="integer")
     */
    private $idProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_image", type="string", length=255)
     */
    private $nomImage;
	
	/**
     * @var boolean
     *
     * @ORM\Column(name="image_principale", type="boolean")
     */
	private $imagePrincipale=false;


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
     * Set idProduit
     *
     * @param integer $idProduit
     *
     * @return Images
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    /**
     * Get idProduit
     *
     * @return int
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * Set nomImage
     *
     * @param string $nomImage
     *
     * @return Images
     */
    public function setNomImage($nomImage)
    {
        $this->nomImage = $nomImage;

        return $this;
    }

    /**
     * Get nomImage
     *
     * @return string
     */
    public function getNomImage()
    {
        return $this->nomImage;
    }

    /**
     * Set imagePrincipale
     *
     * @param boolean $imagePrincipale
     *
     * @return Images
     */
    public function setImagePrincipale($imagePrincipale)
    {
        $this->imagePrincipale = $imagePrincipale;

        return $this;
    }

    /**
     * Get imagePrincipale
     *
     * @return boolean
     */
    public function getImagePrincipale()
    {
        return $this->imagePrincipale;
    }
}

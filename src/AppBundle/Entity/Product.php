<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
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
     * @var ProductCategory
     *
     * @ORM\ManyToOne(targetEntity="ProductCategory", inversedBy="productsList")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="prod_name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="prod_description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="img_url", type="string", length=255)
     */
    private $imgUrl;

    /**
     * @var int
     *
     * @ORM\Column(name="prod_position", type="integer")
     */
    private $position;

    /**
     * @var int
     *
     * @ORM\OneToMany(targetEntity="ProductPropertyCategory", mappedBy="product")
     */
    private $properties;

    /**
     * @var int
     *
     * @ORM\OneToMany(targetEntity="ProductSupplementCategory", mappedBy="product")
     */
    private $supplements;

    /**
     * @var bool
     *
     * @ORM\Column(name="prod_is_take_away_authorized", type="boolean")
     */
    private $isTakeAwayAuthorized;

    /**
     * @var bool
     *
     * @ORM\Column(name="prod_is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var bool
     *
     * @ORM\Column(name="prod_is_sold_out", type="boolean")
     */
    private $isSoldOut;

    /**
     * @var VAT
     *
     * @ORM\ManyToOne(targetEntity="VAT")
     */
    private $vat;

    public function formaterPrix($prix){
        $prix_tab = explode(".", $prix);
        if (strlen($prix_tab[0]) == 1)
            $prix = "0".$prix;
        if (isset($prix_tab[1])) {
            if (strlen($prix_tab[1]) == 1)
                $prix .= "0";
        }else{
            $prix .= ".00";
        }
        return $prix;
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->formaterPrix($this->price);
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\ProductCategory $category
     *
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\ProductCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\ProductCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set imgUrl
     *
     * @param string $imgUrl
     *
     * @return Product
     */
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    /**
     * Get imgUrl
     *
     * @return string
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Product
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->optionGroups = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set isTakeAwayAuthorized
     *
     * @param boolean $isTakeAwayAuthorized
     *
     * @return Product
     */
    public function setIsTakeAwayAuthorized($isTakeAwayAuthorized)
    {
        $this->isTakeAwayAuthorized = $isTakeAwayAuthorized;

        return $this;
    }

    /**
     * Get isTakeAwayAuthorized
     *
     * @return boolean
     */
    public function getIsTakeAwayAuthorized()
    {
        return $this->isTakeAwayAuthorized;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Product
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isSoldOut
     *
     * @param boolean $isSoldOut
     *
     * @return Product
     */
    public function setIsSoldOut($isSoldOut)
    {
        $this->isSoldOut = $isSoldOut;

        return $this;
    }

    /**
     * Get isSoldOut
     *
     * @return boolean
     */
    public function getIsSoldOut()
    {
        return $this->isSoldOut;
    }

    /**
     * Set vat
     *
     * @param \AppBundle\Entity\VAT $vat
     *
     * @return Product
     */
    public function setVat(\AppBundle\Entity\VAT $vat = null)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return \AppBundle\Entity\VAT
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Add property
     *
     * @param \AppBundle\Entity\ProductPropertyCategory $property
     *
     * @return Product
     */
    public function addProperty(\AppBundle\Entity\ProductPropertyCategory $property)
    {
        $this->properties[] = $property;

        return $this;
    }

    /**
     * Remove property
     *
     * @param \AppBundle\Entity\ProductPropertyCategory $property
     */
    public function removeProperty(\AppBundle\Entity\ProductPropertyCategory $property)
    {
        $this->properties->removeElement($property);
    }

    /**
     * Get properties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Add supplement
     *
     * @param \AppBundle\Entity\ProductSupplementCategory $supplement
     *
     * @return Product
     */
    public function addSupplement(\AppBundle\Entity\ProductSupplementCategory $supplement)
    {
        $this->supplements[] = $supplement;

        return $this;
    }

    /**
     * Remove supplement
     *
     * @param \AppBundle\Entity\ProductSupplementCategory $supplement
     */
    public function removeSupplement(\AppBundle\Entity\ProductSupplementCategory $supplement)
    {
        $this->supplements->removeElement($supplement);
    }

    /**
     * Get supplements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSupplements()
    {
        return $this->supplements;
    }
}

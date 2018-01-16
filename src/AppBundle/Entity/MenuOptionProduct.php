<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuOptionProduct
 *
 * @ORM\Table(name="menu_option_product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MenuOptionProductRepository")
 */
class MenuOptionProduct
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
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productsList")
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="MenuOption")
     */
    private $menuOption;

    /**
     * @var Property[]
     *
     * @ORM\ManyToMany(targetEntity="Property")
     */
    private $properties;

    /**
     * @var MenuSize
     *
     * @ORM\ManyToOne(targetEntity="MenuSize", inversedBy="productsList")
     */
    private $size;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;


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
     * Set product
     *
     * @param string $product
     *
     * @return MenuOptionProduct
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set menuOption
     *
     * @param string $menuOption
     *
     * @return MenuOptionProduct
     */
    public function setMenuOption($menuOption)
    {
        $this->menuOption = $menuOption;

        return $this;
    }

    /**
     * Get menuOption
     *
     * @return string
     */
    public function getMenuOption()
    {
        return $this->menuOption;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return MenuOptionProduct
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
        return $this->price;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->properties = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add property
     *
     * @param \AppBundle\Entity\Property $property
     *
     * @return MenuOptionProduct
     */
    public function addProperty(\AppBundle\Entity\Property $property)
    {
        $this->properties[] = $property;

        return $this;
    }

    /**
     * Remove property
     *
     * @param \AppBundle\Entity\Property $property
     */
    public function removeProperty(\AppBundle\Entity\Property $property)
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
     * Set size
     *
     * @param \AppBundle\Entity\MenuSize $size
     *
     * @return MenuOptionProduct
     */
    public function setSize(\AppBundle\Entity\MenuSize $size = null)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return \AppBundle\Entity\MenuSize
     */
    public function getSize()
    {
        return $this->size;
    }
}

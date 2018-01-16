<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductPropertyCategory
 *
 * @ORM\Table(name="product_option_group")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductOptionGroupRepository")
 */
class ProductPropertyCategory
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
     * @ORM\ManyToOne(targetEntity="PropertyCategory")
     */
    private $optionGroup;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="properties")
     */
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(name="opt_grp_position", type="integer")
     */
    private $position;


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
     * Set optionGroup
     *
     * @param string $optionGroup
     *
     * @return ProductPropertyCategory
     */
    public function setOptionGroup($optionGroup)
    {
        $this->optionGroup = $optionGroup;

        return $this;
    }

    /**
     * Get optionGroup
     *
     * @return string
     */
    public function getOptionGroup()
    {
        return $this->optionGroup;
    }

    /**
     * Set product
     *
     * @param string $product
     *
     * @return ProductPropertyCategory
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
     * Set position
     *
     * @param integer $position
     *
     * @return ProductPropertyCategory
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
}

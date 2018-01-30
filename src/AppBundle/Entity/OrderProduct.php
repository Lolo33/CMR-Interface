<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderProduct
 *
 * @ORM\Table(name="order_product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderProductRepository")
 */
class OrderProduct
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
     * @ORM\ManyToOne(targetEntity="Order")
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productList")
     */
    private $product;

    /**
     * @var int
     *
     * @ORM\ManyToMany(targetEntity="Supplement")
     */
    private $supplementsList;

    /**
     * @var int
     *
     * @ORM\ManyToMany(targetEntity="Property")
     */
    private $optionsList;



    public function getPriceTTC(){
        $price = $this->product->getPrice() + ($this->product->getPrice() * ($this->product->getVat()->getRate() / 100));
        foreach ($this->optionsList as $opt)
            $price += $opt->getPrice();
        foreach ($this->supplementsList as $sup)
            $price += $sup->getPrice();
        return Globals::formaterPrix(round($price, 2));
    }

    public function getPriceHT(){
        $price = $this->product->getPrice();
        foreach ($this->optionsList as $opt)
            $price += $opt->getPrice();
        foreach ($this->supplementsList as $sup)
            $price += $sup->getPrice();
        return Globals::formaterPrix(round($price, 2));
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
     * Set product
     *
     * @param string $product
     *
     * @return OrderProduct
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
     * Set order
     *
     * @param \AppBundle\Entity\Order $order
     *
     * @return OrderProduct
     */
    public function setOrder(\AppBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \AppBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->supplementsList = new \Doctrine\Common\Collections\ArrayCollection();
        $this->optionsList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add supplementsList
     *
     * @param \AppBundle\Entity\Supplement $supplementsList
     *
     * @return OrderProduct
     */
    public function addSupplementsList(\AppBundle\Entity\Supplement $supplementsList)
    {
        $this->supplementsList[] = $supplementsList;

        return $this;
    }

    /**
     * Remove supplementsList
     *
     * @param \AppBundle\Entity\Supplement $supplementsList
     */
    public function removeSupplementsList(\AppBundle\Entity\Supplement $supplementsList)
    {
        $this->supplementsList->removeElement($supplementsList);
    }

    /**
     * Get supplementsList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSupplementsList()
    {
        return $this->supplementsList;
    }

    /**
     * Add optionsList
     *
     * @param \AppBundle\Entity\Property $optionsList
     *
     * @return OrderProduct
     */
    public function addOptionsList(\AppBundle\Entity\Property $optionsList)
    {
        $this->optionsList[] = $optionsList;

        return $this;
    }

    /**
     * Remove optionsList
     *
     * @param \AppBundle\Entity\Property $optionsList
     */
    public function removeOptionsList(\AppBundle\Entity\Property $optionsList)
    {
        $this->optionsList->removeElement($optionsList);
    }

    /**
     * Get optionsList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOptionsList()
    {
        return $this->optionsList;
    }
}

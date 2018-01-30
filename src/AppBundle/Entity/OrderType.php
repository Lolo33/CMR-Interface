<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderType
 *
 * @ORM\Table(name="order_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderTypeRepository")
 */
class OrderType
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="RestaurantPaymentMode", mappedBy="orderType")
     */
    private $restaurantPaymentMode;


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
     * @return OrderType
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
     * Constructor
     */
    public function __construct()
    {
        $this->restaurantPaymentMode = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add restaurantPaymentMode
     *
     * @param \AppBundle\Entity\RestaurantPaymentMode $restaurantPaymentMode
     *
     * @return OrderType
     */
    public function addRestaurantPaymentMode(\AppBundle\Entity\RestaurantPaymentMode $restaurantPaymentMode)
    {
        $this->restaurantPaymentMode[] = $restaurantPaymentMode;

        return $this;
    }

    /**
     * Remove restaurantPaymentMode
     *
     * @param \AppBundle\Entity\RestaurantPaymentMode $restaurantPaymentMode
     */
    public function removeRestaurantPaymentMode(\AppBundle\Entity\RestaurantPaymentMode $restaurantPaymentMode)
    {
        $this->restaurantPaymentMode->removeElement($restaurantPaymentMode);
    }

    /**
     * Get restaurantPaymentMode
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRestaurantPaymentMode()
    {
        return $this->restaurantPaymentMode;
    }
}

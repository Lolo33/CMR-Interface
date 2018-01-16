<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contract
 *
 * @ORM\Table(name="contract")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComissionsRepository")
 */
class Contract
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
     * @var Corporate
     *
     * @ORM\ManyToOne(targetEntity="Business")
     */
    private $business;

    /**
     * @var OrderType
     *
     * @ORM\ManyToOne(targetEntity="OrderType")
     */
    private $orderType;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;

    /**
     * @var Restaurant
     *
     * @ORM\ManyToOne(targetEntity="Restaurant")
     */
    private $restaurant;

    /**
     * @var bool
     *
     * @ORM\Column(name="accepted", type="boolean")
     */
    private $accepted;

    /**
     * @var Restaurant
     *
     * @ORM\ManyToOne(targetEntity="FeeType")
     */
    private $type;


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
     * Set orderType
     *
     * @param string $orderType
     *
     * @return Contract
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;

        return $this;
    }

    /**
     * Get orderType
     *
     * @return string
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * Set value
     *
     * @param float $value
     *
     * @return Contract
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set accepted
     *
     * @param boolean $accepted
     *
     * @return Contract
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;

        return $this;
    }

    /**
     * Get accepted
     *
     * @return boolean
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * Set restaurant
     *
     * @param \AppBundle\Entity\Restaurant $restaurant
     *
     * @return Contract
     */
    public function setRestaurant(\AppBundle\Entity\Restaurant $restaurant = null)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return \AppBundle\Entity\Restaurant
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\FeeType $type
     *
     * @return Contract
     */
    public function setType(\AppBundle\Entity\FeeType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get buisness
     *
     * @return \AppBundle\Entity\Business
     */
    public function getBuisness()
    {
        return $this->buisness;
    }

    /**
     * Set business
     *
     * @param \AppBundle\Entity\Business $business
     *
     * @return Contract
     */
    public function setBusiness(\AppBundle\Entity\Business $business = null)
    {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return \AppBundle\Entity\Business
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\FeeType
     */
    public function getType()
    {
        return $this->type;
    }
}

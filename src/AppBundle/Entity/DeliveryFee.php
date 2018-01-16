<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeliveryFee
 *
 * @ORM\Table(name="delivery_fee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DeliveryFeeRepository")
 */
class DeliveryFee
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
     * @ORM\ManyToOne(targetEntity="DeliveryArea")
     */
    private $deliveryArea;

    /**
     * @var float
     *
     * @ORM\Column(name="min_order", type="float")
     */
    private $minOrder;

    /**
     * @var float
     *
     * @ORM\Column(name="max_order", type="float")
     */
    private $maxOrder;

    /**
     * @var float
     *
     * @ORM\Column(name="delivery_fee", type="float")
     */
    private $deliveryFee;


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
     * Set deliveryArea
     *
     * @param string $deliveryArea
     *
     * @return DeliveryFee
     */
    public function setDeliveryArea($deliveryArea)
    {
        $this->deliveryArea = $deliveryArea;

        return $this;
    }

    /**
     * Get deliveryArea
     *
     * @return string
     */
    public function getDeliveryArea()
    {
        return $this->deliveryArea;
    }

    /**
     * Set minOrder
     *
     * @param float $minOrder
     *
     * @return DeliveryFee
     */
    public function setMinOrder($minOrder)
    {
        $this->minOrder = $minOrder;

        return $this;
    }

    /**
     * Get minOrder
     *
     * @return float
     */
    public function getMinOrder()
    {
        return $this->minOrder;
    }

    /**
     * Set maxOrder
     *
     * @param float $maxOrder
     *
     * @return DeliveryFee
     */
    public function setMaxOrder($maxOrder)
    {
        $this->maxOrder = $maxOrder;

        return $this;
    }

    /**
     * Get maxOrder
     *
     * @return float
     */
    public function getMaxOrder()
    {
        return $this->maxOrder;
    }

    /**
     * Set deliveryFee
     *
     * @param float $deliveryFee
     *
     * @return DeliveryFee
     */
    public function setDeliveryFee($deliveryFee)
    {
        $this->deliveryFee = $deliveryFee;

        return $this;
    }

    /**
     * Get deliveryFee
     *
     * @return float
     */
    public function getDeliveryFee()
    {
        return $this->deliveryFee;
    }
}


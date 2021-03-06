<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StandardFee
 *
 * @ORM\Table(name="standard_fee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StandardFeeRepository")
 */
class StandardFee
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
     * @var FeeType
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
     * @return StandardFee
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
     * @return StandardFee
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
     * Set type
     *
     * @param string $type
     *
     * @return StandardFee
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set business
     *
     * @param \AppBundle\Entity\Business $business
     *
     * @return StandardFee
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
}

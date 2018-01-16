<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Business
 *
 * @ORM\Table(name="business")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BuisnessRepository")
 */
class Business extends Corporate
{

    /**
     * @var Order[]
     *
     * @ORM\OneToMany(targetEntity="Order", mappedBy="business")
     */
    private $ordersList;

    /**
     * @var Contract[]
     *
     * @ORM\OneToMany(targetEntity="Contract", mappedBy="business")
     */
    private $appliedFees;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ordersList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ordersList
     *
     * @param \AppBundle\Entity\Order $ordersList
     *
     * @return Business
     */
    public function addOrdersList(\AppBundle\Entity\Order $ordersList)
    {
        $this->ordersList[] = $ordersList;

        return $this;
    }

    /**
     * Remove ordersList
     *
     * @param \AppBundle\Entity\Order $ordersList
     */
    public function removeOrdersList(\AppBundle\Entity\Order $ordersList)
    {
        $this->ordersList->removeElement($ordersList);
    }

    /**
     * Get ordersList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrdersList()
    {
        return $this->ordersList;
    }

    /**
     * Add appliedFee
     *
     * @param \AppBundle\Entity\Contract $appliedFee
     *
     * @return Business
     */
    public function addAppliedFee(\AppBundle\Entity\Contract $appliedFee)
    {
        $this->appliedFees[] = $appliedFee;

        return $this;
    }

    /**
     * Remove appliedFee
     *
     * @param \AppBundle\Entity\Contract $appliedFee
     */
    public function removeAppliedFee(\AppBundle\Entity\Contract $appliedFee)
    {
        $this->appliedFees->removeElement($appliedFee);
    }

    /**
     * Get appliedFees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppliedFees()
    {
        return $this->appliedFees;
    }
}

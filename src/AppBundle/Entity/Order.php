<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @ORM\Table(name="`order`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrdersRepository")
 */
class Order
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
     * @ORM\ManyToOne(targetEntity="Restaurant", inversedBy="ordersList")
     */
    private $restaurant;

    /**
     * @var string
     *
     * @ORM\Column(name="precisions", type="text", nullable=true)
     */
    private $precisions;

    /**
     * @var string
     *
     * @ORM\Column(name="client_name", type="string", length=255)
     */
    private $clientName;

    /**
     * @var string
     *
     * @ORM\Column(name="client_phone", type="string", length=10)
     */
    private $clientPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="client_adress_l1", type="string", length=255)
     */
    private $clientAdressLine1;

    /**
     * @var string
     *
     * @ORM\Column(name="client_adress_l2", type="string", length=255)
     */
    private $clientAdressLine2;

    /**
     * @var string
     *
     * @ORM\Column(name="client_country_code", type="string", length=10)
     */
    private $clientCountryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="client_city", type="string", length=255)
     */
    private $clientCity;

    /**
     * @var string
     *
     * @ORM\Column(name="restaurant_comments", type="text", nullable=true)
     */
    private $restaurantComments;

    /**
     * @var OrderType
     *
     * @ORM\ManyToOne(targetEntity="OrderType")
     */
    private $type;

    /**
     * @var OrderStatusHour
     *
     * @ORM\OneToMany(targetEntity="OrderStatusHour", mappedBy="order")
     */
    private $statusList;

    /**
     * @var Product[]
     *
     * @ORM\ManyToOne(targetEntity="Business", inversedBy="ordersList")
     */
    private $business;

    /**
     * @var Product[]
     *
     * @ORM\OneToMany(targetEntity="OrderProduct", mappedBy="order")
     */
    private $productsList;

    /**
     * @var Product[]
     *
     * @ORM\OneToMany(targetEntity="OrderMenu", mappedBy="order")
     */
    private $menusList;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hourToBeReady", type="datetime")
     */
    private $hourToBeReady;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     */
    private $reference;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_taken_by_buisness", type="float")
     */
    private $amount_taken_by_buisness;



    public function getTotalHT(){
        $prix = 0;
        foreach ($this->getProductsList() as $orderProduct)
            $prix += $orderProduct->getPriceHT();
        return Globals::formaterPrix(round($prix, 2));
    }

    public function getTotalTTC(){
        $prix = 0;
        foreach ($this->getProductsList() as $orderProduct)
            $prix += $orderProduct->getPriceTTC();
        return Globals::formaterPrix(round($prix, 2));
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
     * Set restaurant
     *
     * @param string $restaurant
     *
     * @return Order
     */
    public function setRestaurant($restaurant)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return string
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * Set precisions
     *
     * @param string $precisions
     *
     * @return Order
     */
    public function setPrecisions($precisions)
    {
        $this->precisions = $precisions;

        return $this;
    }

    /**
     * Get precisions
     *
     * @return string
     */
    public function getPrecisions()
    {
        return $this->precisions;
    }

    /**
     * Set clientName
     *
     * @param string $clientName
     *
     * @return Order
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;

        return $this;
    }

    /**
     * Get clientName
     *
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * Set clientPhone
     *
     * @param string $clientPhone
     *
     * @return Order
     */
    public function setClientPhone($clientPhone)
    {
        $this->clientPhone = $clientPhone;

        return $this;
    }

    /**
     * Get clientPhone
     *
     * @return string
     */
    public function getClientPhone()
    {
        return $this->clientPhone;
    }

    /**
     * Set restaurantComments
     *
     * @param string $restaurantComments
     *
     * @return Order
     */
    public function setRestaurantComments($restaurantComments)
    {
        $this->restaurantComments = $restaurantComments;

        return $this;
    }

    /**
     * Get restaurantComments
     *
     * @return string
     */
    public function getRestaurantComments()
    {
        return $this->restaurantComments;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Order
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
     * Constructor
     */
    public function __construct()
    {
        $this->productsList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add statusList
     *
     * @param \AppBundle\Entity\OrderStatusHour $statusList
     *
     * @return Order
     */
    public function addStatusList(\AppBundle\Entity\OrderStatusHour $statusList)
    {
        $this->statusList[] = $statusList;

        return $this;
    }

    /**
     * Remove statusList
     *
     * @param \AppBundle\Entity\OrderStatusHour $statusList
     */
    public function removeStatusList(\AppBundle\Entity\OrderStatusHour $statusList)
    {
        $this->statusList->removeElement($statusList);
    }

    /**
     * Get statusList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatusList()
    {
        return $this->statusList;
    }

    /**
     * Add productsList
     *
     * @param \AppBundle\Entity\OrderProduct $productsList
     *
     * @return Order
     */
    public function addProductsList(\AppBundle\Entity\OrderProduct $productsList)
    {
        $this->productsList[] = $productsList;

        return $this;
    }

    /**
     * Remove productsList
     *
     * @param \AppBundle\Entity\OrderProduct $productsList
     */
    public function removeProductsList(\AppBundle\Entity\OrderProduct $productsList)
    {
        $this->productsList->removeElement($productsList);
    }

    /**
     * Get productsList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductsList()
    {
        return $this->productsList;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Order
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set hourToBeReady
     *
     * @param \DateTime $hourToBeReady
     *
     * @return Order
     */
    public function setHourToBeReady($hourToBeReady)
    {
        $this->hourToBeReady = $hourToBeReady;

        return $this;
    }

    /**
     * Get hourToBeReady
     *
     * @return \DateTime
     */
    public function getHourToBeReady()
    {
        return $this->hourToBeReady->format("Y-m-d H:i:s");
    }

    /**
     * Add menusList
     *
     * @param \AppBundle\Entity\OrderMenu $menusList
     *
     * @return Order
     */
    public function addMenusList(\AppBundle\Entity\OrderMenu $menusList)
    {
        $this->menusList[] = $menusList;

        return $this;
    }

    /**
     * Remove menusList
     *
     * @param \AppBundle\Entity\OrderMenu $menusList
     */
    public function removeMenusList(\AppBundle\Entity\OrderMenu $menusList)
    {
        $this->menusList->removeElement($menusList);
    }

    /**
     * Get menusList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenusList()
    {
        return $this->menusList;
    }

    /**
     * Set business
     *
     * @param \AppBundle\Entity\Business $business
     *
     * @return Order
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
     * Set amountTakenByBuisness
     *
     * @param float $amountTakenByBuisness
     *
     * @return Order
     */
    public function setAmountTakenByBuisness($amountTakenByBuisness)
    {
        $this->amount_taken_by_buisness = $amountTakenByBuisness;

        return $this;
    }

    /**
     * Get amountTakenByBuisness
     *
     * @return float
     */
    public function getAmountTakenByBuisness()
    {
        return $this->amount_taken_by_buisness;
    }

    /**
     * Set clientAdressLine1
     *
     * @param string $clientAdressLine1
     *
     * @return Order
     */
    public function setClientAdressLine1($clientAdressLine1)
    {
        $this->clientAdressLine1 = $clientAdressLine1;

        return $this;
    }

    /**
     * Get clientAdressLine1
     *
     * @return string
     */
    public function getClientAdressLine1()
    {
        return $this->clientAdressLine1;
    }

    /**
     * Set clientAdressLine2
     *
     * @param string $clientAdressLine2
     *
     * @return Order
     */
    public function setClientAdressLine2($clientAdressLine2)
    {
        $this->clientAdressLine2 = $clientAdressLine2;

        return $this;
    }

    /**
     * Get clientAdressLine2
     *
     * @return string
     */
    public function getClientAdressLine2()
    {
        return $this->clientAdressLine2;
    }

    /**
     * Set clientCountryCode
     *
     * @param string $clientCountryCode
     *
     * @return Order
     */
    public function setClientCountryCode($clientCountryCode)
    {
        $this->clientCountryCode = $clientCountryCode;

        return $this;
    }

    /**
     * Get clientCountryCode
     *
     * @return string
     */
    public function getClientCountryCode()
    {
        return $this->clientCountryCode;
    }

    /**
     * Set clientCity
     *
     * @param string $clientCity
     *
     * @return Order
     */
    public function setClientCity($clientCity)
    {
        $this->clientCity = $clientCity;

        return $this;
    }

    /**
     * Get clientCity
     *
     * @return string
     */
    public function getClientCity()
    {
        return $this->clientCity;
    }
}

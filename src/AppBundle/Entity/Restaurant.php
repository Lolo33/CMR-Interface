<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restaurant
 *
 * @ORM\Table(name="restaurant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RestaurantRepository")
 */
class Restaurant extends Corporate
{

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="TypeOfCuisine")
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var bool
     *
     * @ORM\OneToMany(targetEntity="ProductCategory", mappedBy="restaurant")
     */
    private $categoriesOfProducts;

    /**
     * @var bool
     *
     * @ORM\OneToMany(targetEntity="ScheduleBooking", mappedBy="restaurant")
     */
    private $scheduleList;

    /**
     * @var bool
     *
     * @ORM\OneToMany(targetEntity="ScheduleDelivery", mappedBy="restaurant")
     */
    private $scheduleDeliveryList;

    /**
     * @var bool
     *
     * @ORM\OneToMany(targetEntity="ScheduleOrder", mappedBy="restaurant")
     */
    private $scheduleOrderList;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_before_preparation", type="time", options={"default" : "00:15:00"})
     */
    private $timeBeforePreparation;

    /**
     * @var DeliveryTown[]
     *
     * @ORM\ManyToMany(targetEntity="DeliveryTown", inversedBy="restaurants")
     */
    private $townsDeliveredList;

    /**
     * @var DeliveryTown[]
     *
     * @ORM\OneToMany(targetEntity="Order", mappedBy="restaurant")
     */
    private $ordersList;

    /**
     * @var SupplementCategory[]
     *
     * @ORM\OneToMany(targetEntity="SupplementCategory", mappedBy="restaurant")
     */
    private $supplementGroups;

    /**
     * @var Menu[]
     *
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="restaurant")
     */
    private $menus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="booking_duration", type="time", options={"default" : "01:30:00"})
     */
    private $bookingDuration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_to_delivery", type="time", options={"default" : "01:00:00"})
     */
    private $timeToDelivery;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="margin_delivery", type="time", options={"default" : "00:10:00"})
     */
    private $marginDelivery;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cut_line_duration", type="time", options={"default" : "01:00:00"})
     */
    private $cutLineDuration;

    /**
     * @var double
     *
     * @ORM\Column(name="latitude", type="decimal", precision=19, scale=15, nullable=true)
     */
    private $latitude;

    /**
     * @var double
     *
     * @ORM\Column(name="longitude", type="decimal", precision=19, scale=15, nullable=true)
     */
    private $longitude;

    /**
     * @var Table[]
     *
     * @ORM\OneToMany(targetEntity="Table", mappedBy="restaurant")
     */
    private $tables;

    /**
     * @var double
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    private $realHours;

    private $weeklyHours;

    private $deliveryFees;


    /**
     * @return mixed
     */
    public function getRealHours()
    {
        return $this->realHours;
    }

    /**
     * @param mixed $realHours
     */
    public function setRealHours($realHours)
    {
        $this->realHours = $realHours;
    }

    /**
     * @return mixed
     */
    public function getWeeklyHours()
    {
        return $this->weeklyHours;
    }

    /**
     * @param mixed $weeklyHours
     */
    public function setWeeklyHours($weeklyHours)
    {
        $this->weeklyHours = $weeklyHours;
    }

    /**
     * @return mixed
     */
    public function getDeliveryFees()
    {
        return $this->deliveryFees;
    }

    /**
     * @param mixed $deliveryFees
     */
    public function setDeliveryFees($deliveryFees)
    {
        $this->deliveryFees = $deliveryFees;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Restaurant
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
     * Set active
     *
     * @param boolean $active
     *
     * @return Restaurant
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categoriesOfProducts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add categoriesOfProduct
     *
     * @param \AppBundle\Entity\ProductCategory $categoriesOfProduct
     *
     * @return Restaurant
     */
    public function addCategoriesOfProduct(\AppBundle\Entity\ProductCategory $categoriesOfProduct)
    {
        $this->categoriesOfProducts[] = $categoriesOfProduct;

        return $this;
    }

    /**
     * Remove categoriesOfProduct
     *
     * @param \AppBundle\Entity\ProductCategory $categoriesOfProduct
     */
    public function removeCategoriesOfProduct(\AppBundle\Entity\ProductCategory $categoriesOfProduct)
    {
        $this->categoriesOfProducts->removeElement($categoriesOfProduct);
    }

    /**
     * Set categoriesOfProduct
     *
     * @param  $categoriesOfProduct
     */
    public function setCategoriesOfProduct(\Doctrine\Common\Collections\ArrayCollection $categoriesOfProduct)
    {
        $this->categoriesOfProducts = $categoriesOfProduct;
    }
    /**
     * Get categoriesOfProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoriesOfProducts()
    {
        return $this->categoriesOfProducts;
    }

    /**
     * Add scheduleList
     *
     * @param \AppBundle\Entity\ScheduleDelivery $scheduleList
     *
     * @return Restaurant
     */
    public function addScheduleList(\AppBundle\Entity\ScheduleDelivery $scheduleList)
    {
        $this->scheduleList[] = $scheduleList;

        return $this;
    }

    /**
     * Remove scheduleList
     *
     * @param \AppBundle\Entity\ScheduleDelivery $scheduleList
     */
    public function removeScheduleList(\AppBundle\Entity\ScheduleDelivery $scheduleList)
    {
        $this->scheduleList->removeElement($scheduleList);
    }

    /**
     * Get scheduleList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScheduleList()
    {
        return $this->scheduleList;
    }

    /**
     * Set timeBeforePreparation
     *
     * @param \DateTime $timeBeforePreparation
     *
     * @return Restaurant
     */
    public function setTimeBeforePreparation($timeBeforePreparation)
    {
        $this->timeBeforePreparation = $timeBeforePreparation;

        return $this;
    }

    /**
     * Get timeBeforePreparation
     *
     * @return \DateTime
     */
    public function getTimeBeforePreparation()
    {
        return $this->timeBeforePreparation->format("H:i:s");
    }

    /**
     * Add townsDeliveredList
     *
     * @param \AppBundle\Entity\DeliveryTown $townsDeliveredList
     *
     * @return Restaurant
     */
    public function addTownsDeliveredList(\AppBundle\Entity\DeliveryTown $townsDeliveredList)
    {
        $this->townsDeliveredList[] = $townsDeliveredList;

        return $this;
    }

    /**
     * Remove townsDeliveredList
     *
     * @param \AppBundle\Entity\DeliveryTown $townsDeliveredList
     */
    public function removeTownsDeliveredList(\AppBundle\Entity\DeliveryTown $townsDeliveredList)
    {
        $this->townsDeliveredList->removeElement($townsDeliveredList);
    }

    /**
     * Get townsDeliveredList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTownsDeliveredList()
    {
        return $this->townsDeliveredList;
    }

    /**
     * Add ordersList
     *
     * @param \AppBundle\Entity\Order $ordersList
     *
     * @return Restaurant
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
     * Add supplementGroup
     *
     * @param \AppBundle\Entity\SupplementCategory $supplementGroup
     *
     * @return Restaurant
     */
    public function addSupplementGroup(\AppBundle\Entity\SupplementCategory $supplementGroup)
    {
        $this->supplementGroups[] = $supplementGroup;

        return $this;
    }

    /**
     * Remove supplementGroup
     *
     * @param \AppBundle\Entity\SupplementCategory $supplementGroup
     */
    public function removeSupplementGroup(\AppBundle\Entity\SupplementCategory $supplementGroup)
    {
        $this->supplementGroups->removeElement($supplementGroup);
    }

    /**
     * Get supplementGroups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSupplementGroups()
    {
        return $this->supplementGroups;
    }

    /**
     * Add menu
     *
     * @param \AppBundle\Entity\Menu $menu
     *
     * @return Restaurant
     */
    public function addMenu(\AppBundle\Entity\Menu $menu)
    {
        $this->menus[] = $menu;

        return $this;
    }

    /**
     * Remove menu
     *
     * @param \AppBundle\Entity\Menu $menu
     */
    public function removeMenu(\AppBundle\Entity\Menu $menu)
    {
        $this->menus->removeElement($menu);
    }

    /**
     * Get menus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * Set bookingDuration
     *
     * @param \DateTime $bookingDuration
     *
     * @return Restaurant
     */
    public function setBookingDuration($bookingDuration)
    {
        $this->bookingDuration = $bookingDuration;

        return $this;
    }

    /**
     * Get bookingDuration
     *
     * @return \DateTime
     */
    public function getBookingDuration()
    {
        return $this->bookingDuration->format("H:i:s");
    }

    /**
     * Set cutLineDuration
     *
     * @param \DateTime $cutLineDuration
     *
     * @return Restaurant
     */
    public function setCutLineDuration($cutLineDuration)
    {
        $this->cutLineDuration = $cutLineDuration;

        return $this;
    }

    /**
     * Get cutLineDuration
     *
     * @return \DateTime
     */
    public function getCutLineDuration()
    {
        return $this->cutLineDuration;
    }

    /**
     * Set latitude
     *
     * @param \double $latitude
     *
     * @return Restaurant
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return \double
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param \double $longitude
     *
     * @return Restaurant
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return \double
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Add table
     *
     * @param \AppBundle\Entity\Table $table
     *
     * @return Restaurant
     */
    public function addTable(\AppBundle\Entity\Table $table)
    {
        $this->tables[] = $table;

        return $this;
    }

    /**
     * Remove table
     *
     * @param \AppBundle\Entity\Table $table
     */
    public function removeTable(\AppBundle\Entity\Table $table)
    {
        $this->tables->removeElement($table);
    }

    /**
     * Get tables
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**
     * Add scheduleDeliveryList
     *
     * @param \AppBundle\Entity\ScheduleDelivery $scheduleDeliveryList
     *
     * @return Restaurant
     */
    public function addScheduleDeliveryList(\AppBundle\Entity\ScheduleDelivery $scheduleDeliveryList)
    {
        $this->scheduleDeliveryList[] = $scheduleDeliveryList;

        return $this;
    }

    /**
     * Remove scheduleDeliveryList
     *
     * @param \AppBundle\Entity\ScheduleDelivery $scheduleDeliveryList
     */
    public function removeScheduleDeliveryList(\AppBundle\Entity\ScheduleDelivery $scheduleDeliveryList)
    {
        $this->scheduleDeliveryList->removeElement($scheduleDeliveryList);
    }

    /**
     * Get scheduleDeliveryList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScheduleDeliveryList()
    {
        return $this->scheduleDeliveryList;
    }

    /**
     * Add scheduleOrderList
     *
     * @param \AppBundle\Entity\ScheduleOrder $scheduleOrderList
     *
     * @return Restaurant
     */
    public function addScheduleOrderList(\AppBundle\Entity\ScheduleOrder $scheduleOrderList)
    {
        $this->scheduleOrderList[] = $scheduleOrderList;

        return $this;
    }

    /**
     * Remove scheduleOrderList
     *
     * @param \AppBundle\Entity\ScheduleOrder $scheduleOrderList
     */
    public function removeScheduleOrderList(\AppBundle\Entity\ScheduleOrder $scheduleOrderList)
    {
        $this->scheduleOrderList->removeElement($scheduleOrderList);
    }

    /**
     * Get scheduleOrderList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScheduleOrderList()
    {
        return $this->scheduleOrderList;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Restaurant
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set timeToDelivery
     *
     * @param \DateTime $timeToDelivery
     *
     * @return Restaurant
     */
    public function setTimeToDelivery($timeToDelivery)
    {
        $this->timeToDelivery = $timeToDelivery;

        return $this;
    }

    /**
     * Get timeToDelivery
     *
     * @return \DateTime
     */
    public function getTimeToDelivery()
    {
        return $this->timeToDelivery;
    }

    /**
     * Set marginDelivery
     *
     * @param \DateTime $marginDelivery
     *
     * @return Restaurant
     */
    public function setMarginDelivery($marginDelivery)
    {
        $this->marginDelivery = $marginDelivery;

        return $this;
    }

    /**
     * Get marginDelivery
     *
     * @return \DateTime
     */
    public function getMarginDelivery()
    {
        return $this->marginDelivery;
    }
}

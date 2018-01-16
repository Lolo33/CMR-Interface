<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScheduleBooking
 *
 * @ORM\Table(name="schedule_booking")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScheduleBookingRepository")
 */
class ScheduleBooking
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
     * @ORM\ManyToOne(targetEntity="Restaurant")
     */
    private $restaurant;

    /**
     * @var int
     *
     * @ORM\Column(name="day_opening", type="integer")
     */
    private $dayOpening;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hour_opening", type="time")
     */
    private $hourOpening;

    /**
     * @var int
     *
     * @ORM\Column(name="day_closing", type="integer")
     */
    private $dayClosing;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hour_closing", type="time")
     */
    private $hourClosing;

    /**
     * @var string
     *
     * @ORM\Column(name="hour_service", type="integer")
     */
    private $hourService;


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
     * @return ScheduleBooking
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
     * Set dayOpening
     *
     * @param integer $dayOpening
     *
     * @return ScheduleBooking
     */
    public function setDayOpening($dayOpening)
    {
        $this->dayOpening = $dayOpening;

        return $this;
    }

    /**
     * Get dayOpening
     *
     * @return int
     */
    public function getDayOpening()
    {
        return $this->dayOpening;
    }

    /**
     * Set hourOpening
     *
     * @param \DateTime $hourOpening
     *
     * @return ScheduleBooking
     */
    public function setHourOpening($hourOpening)
    {
        $this->hourOpening = $hourOpening;

        return $this;
    }

    /**
     * Get hourOpening
     *
     * @return \DateTime
     */
    public function getHourOpening()
    {
        return $this->hourOpening->format("Y-m-d H:i:s");
    }

    /**
     * Set dayClosing
     *
     * @param integer $dayClosing
     *
     * @return ScheduleBooking
     */
    public function setDayClosing($dayClosing)
    {
        $this->dayClosing = $dayClosing;

        return $this;
    }

    /**
     * Get dayClosing
     *
     * @return int
     */
    public function getDayClosing()
    {
        return $this->dayClosing;
    }

    /**
     * Set hourClosing
     *
     * @param \DateTime $hourClosing
     *
     * @return ScheduleBooking
     */
    public function setHourClosing($hourClosing)
    {
        $this->hourClosing = $hourClosing;

        return $this;
    }

    /**
     * Get hourClosing
     *
     * @return \DateTime
     */
    public function getHourClosing()
    {
        return $this->hourClosing->format("Y-m-d H:i:s");;
    }



    /**
     * Set hourService
     *
     * @param integer $hourService
     *
     * @return ScheduleBooking
     */
    public function setHourService($hourService)
    {
        $this->hourService = $hourService;

        return $this;
    }

    /**
     * Get hourService
     *
     * @return integer
     */
    public function getHourService()
    {
        return $this->hourService;
    }
}

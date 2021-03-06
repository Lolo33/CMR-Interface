<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 */
class Country
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
     * @ORM\Column(name="code", type="string", length=5)
     */
    private $code;

    /**
     * @var Restaurant[]
     *
     * @ORM\OneToMany(targetEntity="Restaurant", mappedBy="country")
     */
    private $restaurantsList;

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
     * @return Country
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
     * Set code
     *
     * @param string $code
     *
     * @return Country
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->restaurantsList = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add restaurantsList
     *
     * @param \AppBundle\Entity\Restaurant $restaurantsList
     *
     * @return Country
     */
    public function addRestaurantsList(\AppBundle\Entity\Restaurant $restaurantsList)
    {
        $this->restaurantsList[] = $restaurantsList;

        return $this;
    }

    /**
     * Remove restaurantsList
     *
     * @param \AppBundle\Entity\Restaurant $restaurantsList
     */
    public function removeRestaurantsList(\AppBundle\Entity\Restaurant $restaurantsList)
    {
        $this->restaurantsList->removeElement($restaurantsList);
    }

    /**
     * Get restaurantsList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRestaurantsList()
    {
        return $this->restaurantsList;
    }
}

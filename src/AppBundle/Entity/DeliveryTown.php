<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Count;

/**
 * DeliveryTown
 *
 * @ORM\Table(name="delivery_town")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DeliveryTownRepository")
 */
class DeliveryTown
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
     * @ORM\Column(name="Code_commune_INSEE", type="string", length=5)
     */
    private $codeINSEE;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Commune", type="string", length=38)
     */
    private $name;

    /**
     * @var Count
     *
     * @ORM\ManyToOne(targetEntity="Country")
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="Code_postal", type="integer", length=5)
     */
    private $countryCode;


    /**
     * @var Restaurant[]
     *
     * @ORM\ManyToMany(targetEntity="Restaurant", mappedBy="townsDeliveredList")
     */
    private $restaurants;

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
     * Set countryCode
     *
     * @param string $countryCode
     *
     * @return DeliveryTown
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->restaurants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add restaurant
     *
     * @param \AppBundle\Entity\Restaurant $restaurant
     *
     * @return DeliveryTown
     */
    public function addRestaurant(\AppBundle\Entity\Restaurant $restaurant)
    {
        $this->restaurants[] = $restaurant;

        return $this;
    }

    /**
     * Remove restaurant
     *
     * @param \AppBundle\Entity\Restaurant $restaurant
     */
    public function removeRestaurant(\AppBundle\Entity\Restaurant $restaurant)
    {
        $this->restaurants->removeElement($restaurant);
    }

    /**
     * Get restaurants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }

    /**
     * Set country
     *
     * @param \AppBundle\Entity\Country $country
     *
     * @return DeliveryTown
     */
    public function setCountry(\AppBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \AppBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set codeINSEE
     *
     * @param string $codeINSEE
     *
     * @return DeliveryTown
     */
    public function setCodeINSEE($codeINSEE)
    {
        $this->codeINSEE = $codeINSEE;

        return $this;
    }

    /**
     * Get codeINSEE
     *
     * @return string
     */
    public function getCodeINSEE()
    {
        return $this->codeINSEE;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return DeliveryTown
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

}

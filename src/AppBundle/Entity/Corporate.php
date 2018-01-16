<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Corporate
 *
 * @ORM\MappedSuperclass
 */
class Corporate
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
     * @ORM\ManyToOne(targetEntity="CorporateStatus")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="adress_line1", type="string", length=255)
     */
    private $adressLine1;

    /**
     * @var string
     *
     * @ORM\Column(name="adress_line2", type="string", length=255, nullable=true)
     */
    private $adressLine2;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=10)
     */
    private $countryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="restaurantsList")
     */
    private $country;

    /**
     * @var Currency
     *
     * @ORM\ManyToOne(targetEntity="Currency")
     */
    private $currency;



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
     * @return Corporate
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
     * Set status
     *
     * @param string $status
     *
     * @return Corporate
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set adressLine1
     *
     * @param string $adressLine1
     *
     * @return Corporate
     */
    public function setAdressLine1($adressLine1)
    {
        $this->adressLine1 = $adressLine1;

        return $this;
    }

    /**
     * Get adressLine1
     *
     * @return string
     */
    public function getAdressLine1()
    {
        return $this->adressLine1;
    }

    /**
     * Set adressLine2
     *
     * @param string $adressLine2
     *
     * @return Corporate
     */
    public function setAdressLine2($adressLine2)
    {
        $this->adressLine2 = $adressLine2;

        return $this;
    }

    /**
     * Get adressLine2
     *
     * @return string
     */
    public function getAdressLine2()
    {
        return $this->adressLine2;
    }

    /**
     * Set countryCode
     *
     * @param string $countryCode
     *
     * @return Corporate
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
     * Set country
     *
     * @param string $country
     *
     * @return Corporate
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set currency
     *
     * @param \AppBundle\Entity\Currency $currency
     *
     * @return Corporate
     */
    public function setCurrency(\AppBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \AppBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Corporate
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Corporate
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Corporate
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
}

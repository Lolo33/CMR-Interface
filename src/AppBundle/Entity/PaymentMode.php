<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentMode
 *
 * @ORM\Table(name="payment_mode")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentModeRepository")
 */
class PaymentMode
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
     * @ORM\Column(name="mode_name", type="string", length=255)
     */
    private $modeName;

    /**
     * @var string
     *
     * @ORM\Column(name="mode_description", type="text")
     */
    private $modeDescription;


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
     * Set modeName
     *
     * @param string $modeName
     *
     * @return PaymentMode
     */
    public function setModeName($modeName)
    {
        $this->modeName = $modeName;

        return $this;
    }

    /**
     * Get modeName
     *
     * @return string
     */
    public function getModeName()
    {
        return $this->modeName;
    }

    /**
     * Set modeDescription
     *
     * @param string $modeDescription
     *
     * @return PaymentMode
     */
    public function setModeDescription($modeDescription)
    {
        $this->modeDescription = $modeDescription;

        return $this;
    }

    /**
     * Get modeDescription
     *
     * @return string
     */
    public function getModeDescription()
    {
        return $this->modeDescription;
    }
}

<?php

namespace Ihk\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rule
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ihk\BaseBundle\Entity\RuleRepository")
 */
class Rule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="day_in_week", type="string", length=32)
     */
    private $dayInWeek;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="starttime", type="time")
     */
    private $starttime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endtime", type="time")
     */
    private $endtime;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Rule
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set dayInWeek
     *
     * @param string $dayInWeek
     * @return Rule
     */
    public function setDayInWeek($dayInWeek)
    {
        $this->dayInWeek = $dayInWeek;

        return $this;
    }

    /**
     * Get dayInWeek
     *
     * @return string 
     */
    public function getDayInWeek()
    {
        return $this->dayInWeek;
    }

    /**
     * Set starttime
     *
     * @param \DateTime $starttime
     * @return Rule
     */
    public function setStarttime($starttime)
    {
        $this->starttime = $starttime;

        return $this;
    }

    /**
     * Get starttime
     *
     * @return \DateTime 
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * Set endtime
     *
     * @param string $endtime
     * @return Rule
     */
    public function setEndtime($endtime)
    {
        $this->endtime = $endtime;

        return $this;
    }

    /**
     * Get endtime
     *
     * @return string 
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Rule
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }
}

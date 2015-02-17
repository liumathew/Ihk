<?php

namespace Ihk\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ihk\UserBundle\Entity\User;

/**
 * Kitchen
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ihk\BaseBundle\Entity\KitchenRepository")
 */
class Kitchen
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
     * @ORM\Column(name="name", type="string", length=32)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="decimal")
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=16, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="owner_id", type="string", length=32, unique=true)
	 */
	private $ownerId;//todo:add unique constraint and access denied exception handler

	/**
	 * @param string $ownerId
	 *
	 * @return Kitchen
	 */
	public function setOwnerId($ownerId)
	{
		$this->ownerId = $ownerId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getOwnerId()
	{
		return $this->ownerId;
	}


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
     * Set name
     *
     * @param string $name
     * @return Kitchen
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
     * Set description
     *
     * @param string $description
     * @return Kitchen
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set score
     *
     * @param string $score
     * @return Kitchen
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Kitchen
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Kitchen
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

	public function isOwner(User $user = null)
	{
		return $user && $user->getId() == $this->getOwnerId();
	}

}

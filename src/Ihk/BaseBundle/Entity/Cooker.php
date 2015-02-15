<?php

namespace Ihk\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cooker
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ihk\BaseBundle\Entity\CookerRepository")
 */
class Cooker
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
     * @ORM\Column(name="photo", type="string", length=32, nullable=true)
     */
    private $photo;

    /**
     * @var integer
     *
     * @ORM\Column(name="kitchen_id", type="integer")
     */
    private $kitchenId;


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
     * @return Cooker
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
     * @return Cooker
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
     * Set photo
     *
     * @param string $photo
     * @return Cooker
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set kitchenId
     *
     * @param integer $kitchenId
     * @return Cooker
     */
    public function setKitchenId($kitchenId)
    {
        $this->kitchenId = $kitchenId;

        return $this;
    }

    /**
     * Get kitchenId
     *
     * @return integer 
     */
    public function getKitchenId()
    {
        return $this->kitchenId;
    }
}

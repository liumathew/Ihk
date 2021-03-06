<?php

namespace Ihk\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dish
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ihk\BaseBundle\Entity\DishRepository")
 */
class Dish
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")

	 */
    private  $id;

	/**
	 * @var integer
	 * @ORM\ManyToMany(targetEntity="Ihk\BaseBundle\Entity\Tag")
	 * @ORM\JoinTable(name="Dishes_Tags",
	 *      joinColumns={@ORM\JoinColumn(name="dish_id", referencedColumnName="id")},
	 * 		inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")})
	 */
	private $tags;

	/**
	 * @param int $tags
	 *
	 * @return $this
	 */
	public function setTags($tags)
	{
		$this->tags = $tags;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getTags()
	{
		return $this->tags;
	}


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
	 * @var int
	 *
	 * @ORM\Column(name="score", type="integer")
	 */
	private $score;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

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
     * @return Dish
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
     * @return Dish
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
     * @return Dish
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
	 * @param int $score
	 *
	 * @return $this
	 */
	public function setScore($score)
	{
		$this->score = $score;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getScore()
	{
		return $this->score;
	}

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Dish
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set kitchenId
     *
     * @param integer $kitchenId
     * @return Dish
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->getName();
	}
    /**
     * Add tags
     *
     * @param \Ihk\BaseBundle\Entity\Tag $tags
     * @return Dish
     */
    public function addTag(\Ihk\BaseBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Ihk\BaseBundle\Entity\Tag $tags
     */
    public function removeTag(\Ihk\BaseBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

}

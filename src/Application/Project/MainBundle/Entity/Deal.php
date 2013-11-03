<?php

namespace Application\Project\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Sonata\UserBundle\Entity\User;
use Application\Project\MainBundle\Entity\Content;

/**
 * Deal
 *
 * @ORM\Table(name="deal")
 * @ORM\Entity
 */
class Deal
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="Content")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     */
    private $contents;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->contents = new ArrayCollection();
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Deal
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
     * Set status
     *
     * @param integer $status
     * @return Deal
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Deal
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set users
     *
     * @param ArrayCollection $users
     * @return Deal
     */
    public function setUsers(ArrayCollection $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return ArrayCollection|array
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set contents
     *
     * @param ArrayCollection $contents
     * @return Deal
     */
    public function setContents(ArrayCollection $contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Get contents
     *
     * @return ArrayCollection|array
     */
    public function getContents()
    {
        return $this->contents;
    }
}

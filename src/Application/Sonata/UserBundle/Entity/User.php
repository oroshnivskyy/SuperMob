<?php

namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use FOS\UserBundle\Model\GroupInterface;
use Doctrine\ORM\Mapping as ORM;

use Application\Project\MainBundle\Entity\Operator;

/**
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $groups;

    /**
     * @ORM\ManyToOne(targetEntity="Operator")
     * @ORM\JoinColumn(name="operator_id", referencedColumnName="id")
     */
    private $operator;

    /**
     * @var integer
     */
    private $country;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add groups
     *
     * @param \Application\Sonata\UserBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(GroupInterface $groups)
    {
        $this->groups[] = $groups;
    
        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Application\Sonata\UserBundle\Entity\Group $groups
     */
    public function removeGroup(GroupInterface $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
    /**
     * @var integer
     */
    private $userCard;


    /**
     * Set userCard
     *
     * @param integer $userCard
     * @return User
     */
    public function generateUserCard()
    {
        $this->userCard = substr(crc32(uniqid()).crc32(uniqid()),0,16);
    
        return $this;
    }

    /**
     * Get userCard
     *
     * @return integer 
     */
    public function getUserCard()
    {
        return $this->userCard;
    }

    /**
     * Set Operator
     *
     * @param Operator $operator
     * @return Code
     */
    public function setOperator(Operator $operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return Operator|NULL
     */
    public function getOperator()
    {
        return $this->operator;
    }


    /**
     * Get country
     *
     * @return integer
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function getFormatingCard()
    {
        $card = substr($this->userCard, 0, 4).'-';
        $card .= substr($this->userCard, 4, 4).'-';
        $card .= substr($this->userCard, 8, 4).'-';
        $card .= substr($this->userCard, 12, 4);


        return $card;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist(){
        $this->generateUserCard();
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }
}
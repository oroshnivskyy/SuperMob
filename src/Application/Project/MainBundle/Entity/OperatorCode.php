<?php

namespace Application\Project\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperatorCode
 *
 * @ORM\Table(name="operator_code")
 * @ORM\Entity
 */
class OperatorCode
{
    const STATUS_REMOVED = false;
    const STATUS_OK = true;
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
     * @ORM\Column(name="code", type="string", length=30)
     */
    private $code;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Operator", inversedBy="operatorCodes")
     * @ORM\JoinColumn(name="operator_id", referencedColumnName="id")
     */
    private $operator;

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
     * Set code
     *
     * @param string $code
     * @return OperatorCode
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
     * Set status
     *
     * @param integer $status
     * @return OperatorCode
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
    
    public function __construct(){
        $this->setStatus(self::STATUS_OK);
    }
}

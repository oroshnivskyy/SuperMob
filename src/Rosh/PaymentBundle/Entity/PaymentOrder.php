<?php

namespace Rosh\PaymentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentOrder
 *
 * @ORM\Table(name="payment_order")
 * @ORM\Entity(repositoryClass="Rosh\PaymentBundle\Entity\PaymentOrderRepository")
 */
class PaymentOrder
{
    const STATUS_CREATED = 1;
    const STATUS_SENT = 2;
    const STATUS_SUCCESS = 3;
    const STATUS_FAIL = 4;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="purchaseId", type="integer")
     */
    private $purchaseId;

    /**
     * @var string
     *
     * @ORM\Column(name="purchaseClass", type="string", length=255)
     */
    private $purchaseClass;

    /**
     * @var float
     *
     * @ORM\Column(name="purchaseCost", type="decimal")
     */
    private $purchaseCost;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var float
     *
     * @ORM\Column(name="service_tid", type="string", length=255)
     */
    private $serviceTid;
    /**
     * @var float
     *
     * @ORM\Column(name="service_purchase_name", type="string", length=255)
     */
    private $servicePurchaseName;
    /**
     * @var float
     *
     * @ORM\Column(name="service_comment", type="string", length=255)
     */
    private $serviceComment;
    /**
     * @var float
     *
     * @ORM\Column(name="service_partner_id", type="string", length=255)
     */
    private $servicePartnerId;
    /**
     * @var float
     *
     * @ORM\Column(name="service_id", type="string", length=255)
     */
    private $serviceId;
    /**
     * @var float
     *
     * @ORM\Column(name="service_type", type="string", length=20)
     */
    private $serviceType;
    /**
     * @var float
     *
     * @ORM\Column(name="service_partner_income", type="decimal")
     */
    private $servicePartnerIncome;
    /**
     * @var float
     *
     * @ORM\Column(name="service_system_income", type="decimal")
     */
    private $serviceSystemIncome;

    public function __construct(){
        $this->setStatus(self::STATUS_CREATED);
        $this->setServiceTid("");
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
     * Set purchaseId
     *
     * @param integer $purchaseId
     * @return PaymentOrder
     */
    public function setPurchaseId($purchaseId)
    {
        $this->purchaseId = $purchaseId;
    
        return $this;
    }

    /**
     * Get purchaseId
     *
     * @return integer 
     */
    public function getPurchaseId()
    {
        return $this->purchaseId;
    }

    /**
     * Set purchaseClass
     *
     * @param class $purchase
     * @return PaymentOrder
     */
    public function setPurchase($purchase)
    {
        $this->setPurchaseId($purchase->getid());
        $this->purchaseClass = get_class($purchase);
        $this->setPurchaseCost($purchase->getCost());
        $this->setServicePurchaseName("");
        $this->setServiceComment("");
        $this->setServicePartnerId("");
        $this->setServiceId("");
        $this->setServiceType("");
        $this->setServicePartnerIncome(0);
        $this->setServiceSystemIncome(0);

        return $this;
    }

    /**
     * Get purchaseClass
     *
     * @return string 
     */
    public function getPurchaseClass()
    {
        return $this->purchaseClass;
    }

    /**
     * Set purchaseCost
     *
     * @param float $purchaseCost
     * @return PaymentOrder
     */
    public function setPurchaseCost($purchaseCost)
    {
        $this->purchaseCost = $purchaseCost;
        return $this;
    }

    /**
     * Get purchaseCost
     *
     * @return float 
     */
    public function getPurchaseCost()
    {
        return $this->purchaseCost;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return PaymentOrder
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return PaymentOrder
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
     * Set purchaseClass
     *
     * @param string $purchaseClass
     * @return PaymentOrder
     */
    public function setPurchaseClass($purchaseClass)
    {
        $this->purchaseClass = $purchaseClass;
    
        return $this;
    }

    /**
     * Set serviceTid
     *
     * @param string $serviceTid
     * @return PaymentOrder
     */
    public function setServiceTid($serviceTid)
    {
        $this->serviceTid = $serviceTid;
    
        return $this;
    }

    /**
     * Get serviceTid
     *
     * @return string 
     */
    public function getServiceTid()
    {
        return $this->serviceTid;
    }

    /**
     * Set servicePurchaseName
     *
     * @param string $servicePurchaseName
     * @return PaymentOrder
     */
    public function setServicePurchaseName($servicePurchaseName)
    {
        $this->servicePurchaseName = $servicePurchaseName;
    
        return $this;
    }

    /**
     * Get servicePurchaseName
     *
     * @return string 
     */
    public function getServicePurchaseName()
    {
        return $this->servicePurchaseName;
    }

    /**
     * Set serviceComment
     *
     * @param string $serviceComment
     * @return PaymentOrder
     */
    public function setServiceComment($serviceComment)
    {
        $this->serviceComment = $serviceComment;
    
        return $this;
    }

    /**
     * Get serviceComment
     *
     * @return string 
     */
    public function getServiceComment()
    {
        return $this->serviceComment;
    }

    /**
     * Set servicePartnerId
     *
     * @param string $partnerId
     * @return PaymentOrder
     */
    public function setServicePartnerId($partnerId)
    {
        $this->servicePartnerId = $partnerId;
    
        return $this;
    }

    /**
     * Get partnerId
     *
     * @return string 
     */
    public function getServicePartnerId()
    {
        return $this->servicePartnerId;
    }

    /**
     * Set serviceId
     *
     * @param string $serviceId
     * @return PaymentOrder
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
    
        return $this;
    }

    /**
     * Get serviceId
     *
     * @return string 
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * Set serviceType
     *
     * @param string $serviceType
     * @return PaymentOrder
     */
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;
    
        return $this;
    }

    /**
     * Get serviceType
     *
     * @return string 
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * Set servicePartnerIncome
     *
     * @param float $servicePartnerIncome
     * @return PaymentOrder
     */
    public function setServicePartnerIncome($servicePartnerIncome)
    {
        $this->servicePartnerIncome = $servicePartnerIncome;
    
        return $this;
    }

    /**
     * Get servicePartnerIncome
     *
     * @return float 
     */
    public function getServicePartnerIncome()
    {
        return $this->servicePartnerIncome;
    }

    /**
     * Set serviceSystemIncome
     *
     * @param float $serviceSystemIncome
     * @return PaymentOrder
     */
    public function setServiceSystemIncome($serviceSystemIncome)
    {
        $this->serviceSystemIncome = $serviceSystemIncome;
    
        return $this;
    }

    /**
     * Get serviceSystemIncome
     *
     * @return float 
     */
    public function getServiceSystemIncome()
    {
        return $this->serviceSystemIncome;
    }

}
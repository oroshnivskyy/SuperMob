<?php

namespace Application\Project\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Project\MainBundle\Entity\Service;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Content
 *
 * @ORM\Table(name="content")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 *
 */
class Content
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="short_text", type="text", nullable=true)
     */
    private $shortText;

    /**
     * @var string
     *
     * @ORM\Column(name="big_text", type="text", nullable=true)
     */
    private $bigText;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=500)
     * @Assert\Url()
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="contents")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $service;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    private $uploadRootDir;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="date", nullable=true)
     */
    private $updatedAt;
    /**
     * Set pubDate
     *
     * @param \DateTime $pubDate
     * @return News
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get pubDate
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PostLoad
     */
    public function updatedAt(){
        $this->setUpdatedAt(new \DateTime());
    }
    
    public function __construct(){
        $this->setCode(uniqid('code-'));
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
     * @return Content
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
     * Set shortText
     *
     * @param string $shortText
     * @return Content
     */
    public function setShortText($shortText)
    {
        $this->shortText = $shortText;
    
        return $this;
    }

    /**
     * Get shortText
     *
     * @return string 
     */
    public function getShortText()
    {
        return $this->shortText;
    }

    /**
     * Set bigText
     *
     * @param string $bigText
     * @return Content
     */
    public function setBigText($bigText)
    {
        $this->bigText = $bigText;
    
        return $this;
    }

    /**
     * Get bigText
     *
     * @return string 
     */
    public function getBigText()
    {
        return $this->bigText;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Content
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
     * Set type
     *
     * @param integer $type
     * @return Content
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Content
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
     * Set price
     *
     * @param integer $price
     * @return Content
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
     * Set url
     *
     * @param string $url
     * @return Content
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get service
     *
     * @return Service|NULL
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set service
     *
     * @param Service $service
     * @return Content
     */
    public function setService(Service $service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile( UploadedFile $file = null ){
        $this->file = $file;
        $this->image = isset($file)?$file->getBasename():$this->image;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile(){
        return $this->file;
    }

    public function upload(){
        $uploadedFile = $this->getFile();
        if(!isset($uploadedFile)){
            return;
        }
        if ( !$this->getUploadRootDir() ){
            throw new ValidatorException( 'Upload Root dir not set' );
        }

        $fileName = sha1( uniqid( mt_rand(), true ) ) . '.' . $uploadedFile->guessExtension();
        $uploadedFile->move(
            $this->getUploadRootDir(),
            $fileName
        );

        $this->image = $fileName;

        $this->setFile( null );
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function lifecycleFileUpload(){
        $this->upload();
    }

    public function setUploadRootDir( $path ){
        $this->uploadRootDir = $path;
    }

    protected function getUploadRootDir(){
        return $this->uploadRootDir;
    }
    /**
     * Get image
     *
     * @return string
     */
    public function getImage(){
        return $this->image;
    }
}

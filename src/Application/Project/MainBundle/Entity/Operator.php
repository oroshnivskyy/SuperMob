<?php

namespace Application\Project\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Operator
 *
 * @ORM\Table(name="operator")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Operator
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
     * @ORM\Column(name="url", type="string", length=500, nullable=true)
     * @Assert\Url()
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="country", type="smallint")
     */
    private $country;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

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
     * @ORM\OneToMany(targetEntity="Code", mappedBy="operator")
     */
    private $codes;

    public function __construct() {
        $this->codes = new ArrayCollection();
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
     * @return Operator
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
     * Set url
     *
     * @param string $url
     * @return Operator
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
     * Set country
     *
     * @param integer $country
     * @return Operator
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
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
     * Set status
     *
     * @param boolean $status
     * @return Operator
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Slider
     */
    public function setImage( $image ){
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage(){
        return $this->image;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile( UploadedFile $file = null ){
        $this->file = $file;
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
        if ( !$this->getUploadRootDir() ){
            throw new ValidatorException( 'Upload Root dir not set' );
        }

        $uploadedFile = $this->getFile();
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
     * Set codes
     *
     * @param ArrayCollection $codes
     * @return Operator
     */
    public function setCodes(ArrayCollection $codes)
    {
        $this->codes = $codes;

        return $this;
    }

    /**
     * Get status
     *
     * @return ArrayCollection|array
     */
    public function getCodes()
    {
        return $this->codes;
    }
}

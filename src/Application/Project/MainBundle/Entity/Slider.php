<?php

namespace Application\Project\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Slider
 *
 * @ORM\Table(name="slider")
 * @ORM\Entity(repositoryClass="Application\Project\MainBundle\Repository\SliderRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Slider{
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
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     * @Assert\Url()
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="url_name", type="string", length=255)
     */
    private $urlName;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

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
    /**
     * Get id
     *
     * @return integer
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Slider
     */
    public function setName( $name ){
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Slider
     */
    public function setText( $text ){
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText(){
        return $this->text;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Slider
     */
    public function setUrl( $url ){
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(){
        return $this->url;
    }

    /**
     * Set urlName
     *
     * @param string $urlName
     * @return Slider
     */
    public function setUrlName( $urlName ){
        $this->urlName = $urlName;

        return $this;
    }

    /**
     * Get urlName
     *
     * @return string
     */
    public function getUrlName(){
        return $this->urlName;
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
     * Set status
     *
     * @param boolean $status
     * @return Slider
     */
    public function setStatus( $status ){
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus(){
        return $this->status;
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
        $uploadedFile = $this->getFile();
        if(!isset($uploadedFile)){
            return;
        }
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
}

<?php

namespace Application\Project\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewsLink
 *
 * @ORM\Table(name="news_link")
 * @ORM\Entity
 */
class NewsLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     * @Assert\Regex("/^\w+$/")
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=true)
     */
    private $text;

    /**
     * @var \News
     *
     * @ORM\ManyToOne(targetEntity="News")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="news_id", referencedColumnName="id")
     * })
     */
    private $news;



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
     * Set url
     *
     * @param string $url
     * @return NewsLink
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
     * Set text
     *
     * @param string $text
     * @return NewsLink
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set news
     *
     * @param \Application\Project\MainBundle\Entity\News $news
     * @return NewsLink
     */
    public function setNews(\Application\Project\MainBundle\Entity\News $news = null)
    {
        $this->news = $news;
    
        return $this;
    }

    /**
     * Get news
     *
     * @return \Application\Project\MainBundle\Entity\News 
     */
    public function getNews()
    {
        return $this->news;
    }
}
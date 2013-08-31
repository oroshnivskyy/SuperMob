<?php

namespace Application\Project\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
<<<<<<< HEAD
use Doctrine\Common\Collections\ArrayCollection;
use Application\Project\MainBundle\Entity\NewsLink;
use Application\Project\MainBundle\Entity\NewsCategory;
=======
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity
 */
class News
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="announce", type="text", nullable=true)
     */
    private $announce;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pub_date", type="date", nullable=true)
     */
    private $pubDate;

    /**
     * @var \NewsCategory
     *
     * @ORM\ManyToOne(targetEntity="NewsCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="news_category_id", referencedColumnName="id")
     * })
     */
    private $newsCategory;

<<<<<<< HEAD
    /**
     * @ORM\OneToMany(targetEntity="NewsLink", mappedBy="news", cascade={"all"})
     */
    protected $newsLinks;

    public function __construct()
    {
        $this->newsLinks = new ArrayCollection();
        $this->pubDate = new \DateTime('now');
    }
=======

>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771

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
     * Set title
     *
     * @param string $title
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set announce
     *
     * @param string $announce
     * @return News
     */
    public function setAnnounce($announce)
    {
        $this->announce = $announce;
    
        return $this;
    }

    /**
     * Get announce
     *
     * @return string 
     */
    public function getAnnounce()
    {
        return $this->announce;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return News
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
     * Set pubDate
     *
     * @param \DateTime $pubDate
     * @return News
     */
    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;
    
        return $this;
    }

    /**
     * Get pubDate
     *
     * @return \DateTime 
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    /**
     * Set newsCategory
     *
<<<<<<< HEAD
     * @param NewsCategory $newsCategory
     * @return News
     */
    public function setNewsCategory(NewsCategory $newsCategory = null)
=======
     * @param \Application\Project\MainBundle\Entity\NewsCategory $newsCategory
     * @return News
     */
    public function setNewsCategory(\Application\Project\MainBundle\Entity\NewsCategory $newsCategory = null)
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
    {
        $this->newsCategory = $newsCategory;
    
        return $this;
    }

    /**
     * Get newsCategory
     *
<<<<<<< HEAD
     * @return NewsCategory 
=======
     * @return \Application\Project\MainBundle\Entity\NewsCategory 
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
     */
    public function getNewsCategory()
    {
        return $this->newsCategory;
    }
<<<<<<< HEAD

    /**
     * Add newsLinks
     *
     * @param NewsLink $newsLinks
     * @return News
     */
    public function addNewsLink(NewsLink $newsLinks)
    {
        $this->newsLinks[] = $newsLinks;
    
        return $this;
    }

    /**
     * Remove newsLinks
     *
     * @param NewsLink $newsLinks
     */
    public function removeNewsLink(NewsLink $newsLinks)
    {
        $this->newsLinks->removeElement($newsLinks);
    }

    /**
     * Get newsLinks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNewsLinks()
    {
        return $this->newsLinks;
    }
=======
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
}
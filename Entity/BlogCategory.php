<?php

namespace Mockizart\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * BlogCategory
 */
class BlogCategory
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $content;

    /**
     * @var integer
     */
    private $parentId;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var integer
     */
    private $totalPost;

    /**
     * @var boolean
     */
    private $type;


    private $children;

    private $parent;

    public function __construct() {
        $this->children = new ArrayCollection();
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
     * Set created
     *
     * @param \DateTime $created
     * @return BlogCategory
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return BlogCategory
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
     * Set content
     *
     * @param string $content
     * @return BlogCategory
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    public function setParent(BlogCategory $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return BlogCategory
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Add children
     *
     * @param BlogCategory $children
     * @return BlogCategory
     */
    public function addChild(BlogCategory $children)
    {
        $this->children[] = $children;
        return $this;
    }
    /**
     * Remove children
     *
     * @param BlogCategory $children
     */
    public function removeChild(BlogCategory $children)
    {
        $this->children->removeElement($children);
    }
    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return BlogCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set totalPost
     *
     * @param integer $totalPost
     * @return BlogCategory
     */
    public function setTotalPost($totalPost)
    {
        $this->totalPost = $totalPost;

        return $this;
    }

    /**
     * Get totalPost
     *
     * @return integer 
     */
    public function getTotalPost()
    {
        return $this->totalPost;
    }

    /**
     * Set type
     *
     * @param boolean $type
     * @return BlogCategory
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }
}

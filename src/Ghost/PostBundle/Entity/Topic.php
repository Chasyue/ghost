<?php
namespace Ghost\PostBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Topic entity
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
class Topic
{
    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $body
     */
    private $body;

    /**
     * @var integer $viewsCount
     */
    private $viewsCount = 0;

    /**
     * @var integer $repliesCount
     */
    private $repliesCount = 0;

    /**
     * @var boolean $isDeleted
     */
    private $isDeleted = false;

    /**
     * @var integer $created
     */
    private $created;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var ArrayCollection
     */
    private $posts;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Category
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts   = new ArrayCollection();
        $this->created = time();
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Topic
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
     * Set body
     *
     * @param string $body
     *
     * @return Topic
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set viewsCount
     *
     * @param integer $viewsCount
     *
     * @return Topic
     */
    public function setViewsCount($viewsCount)
    {
        $this->viewsCount = $viewsCount;

        return $this;
    }

    /**
     * Get viewsCount
     *
     * @return integer
     */
    public function getViewsCount()
    {
        return $this->viewsCount;
    }

    /**
     * Set repliesCount
     *
     * @param integer $repliesCount
     *
     * @return Topic
     */
    public function setRepliesCount($repliesCount)
    {
        $this->repliesCount = $repliesCount;

        return $this;
    }

    /**
     * Get repliesCount
     *
     * @return integer
     */
    public function getRepliesCount()
    {
        return $this->repliesCount;
    }

    /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return Topic
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return Topic
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated()
    {
        return $this->created;
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
     * Add posts
     *
     * @param Post $posts
     *
     * @return Topic
     */
    public function addPost(Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param Post $posts
     */
    public function removePost(Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Topic
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set category
     *
     * @param Category $category
     *
     * @return Topic
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}

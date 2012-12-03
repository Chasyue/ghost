<?php
namespace Ghost\PostBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Ghost\UserBundle\Model\User;

/**
 * Topic entity
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
abstract class Topic implements TopicInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var string $body
     */
    protected $body;

    /**
     * @var integer $viewsCount
     */
    protected $viewsCount = 0;

    /**
     * @var integer $repliesCount
     */
    protected $repliesCount = 0;

    /**
     * @var boolean $isDeleted
     */
    protected $isDeleted = false;

    /**
     * @var integer $created
     */
    protected $created;

    /**
     * @var integer
     */
    protected $lastPost;

    /**
     * @var string
     */
    protected $lastPoster;

    /**
     * @var ArrayCollection
     */
    protected $posts;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Category
     */
    protected $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts       = new ArrayCollection();
        $this->created     = time();
        $this->lastPost = time();
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritDoc}
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * {@inheritDoc}
     */
    public function incrementViewsCount($by = 1)
    {
        $this->viewsCount += intval($by);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getViewsCount()
    {
        return $this->viewsCount;
    }

    /**
     * {@inheritDoc}
     */
    public function incrementRepliesCount($by = 1)
    {
        $this->repliesCount += intval($by);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRepliesCount()
    {
        return $this->repliesCount;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = (boolean)$isDeleted;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * {@inheritDoc}
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function addPost(Post $posts)
    {
        $this->posts->add($posts);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removePost(Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * {@inheritDoc}
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * {@inheritDoc}
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * {@inheritDoc}
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * {@inheritDoc}
     */
    public function setLastPost($lastPost)
    {
        $this->lastPost = $lastPost;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLastPost()
    {
        return $this->lastPost;
    }

    /**
     * {@inheritDoc}
     */
    public function setLastPoster($lastPoster)
    {
        $this->lastPoster = $lastPoster;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLastPoster()
    {
        return $this->lastPoster;
    }
}

<?php
namespace Ghost\PostBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Ghost\UserBundle\Model\User;

/**
 * Topic Interface
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface TopicInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set body
     *
     * @param string $body
     *
     * @return self
     */
    public function setBody($body);


    /**
     * Get body
     *
     * @return string
     */
    public function getBody();

    /**
     * Increment viewsCount
     *
     * @param integer $by
     *
     * @return self
     */
    public function incrementViewsCount($by = 1);

    /**
     * Get viewsCount
     *
     * @return integer
     */
    public function getViewsCount();

    /**
     * Increment repliesCount
     *
     * @param integer $by
     *
     * @return self
     */
    public function incrementRepliesCount($by = 1);

    /**
     * Get repliesCount
     *
     * @return integer
     */
    public function getRepliesCount();

    /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return self
     */
    public function setIsDeleted($isDeleted);

    /**
     * Get isDeleted
     *
     * @return boolean
     */
    public function isDeleted();

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated();

    /**
     * Add posts
     *
     * @param Post $posts
     *
     * @return self
     */
    public function addPost(Post $posts);

    /**
     * Remove posts
     *
     * @param Post $posts
     */
    public function removePost(Post $posts);

    /**
     * Get posts
     *
     * @return ArrayCollection
     */
    public function getPosts();

    /**
     * Set user
     *
     * @param User $user
     *
     * @return self
     */
    public function setUser(User $user = null);

    /**
     * Get user
     *
     * @return User
     */
    public function getUser();

    /**
     * Set category
     *
     * @param Category $category
     *
     * @return self
     */
    public function setCategory(Category $category = null);

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory();

    /**
     * @param integer $lastPost
     *
     * @return self
     */
    public function setLastPost($lastPost);

    /**
     * @return integer
     */
    public function getLastPost();

    /**
     * @param string $lastPoster
     *
     * @return self
     */
    public function setLastPoster($lastPoster);

    /**
     * @return string
     */
    public function getLastPoster();
}

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
     * @return Topic
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
     * @return Topic
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
     * @return Topic
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
     * @return Topic
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
     * @return Topic
     */
    public function setIsDeleted($isDeleted);

    /**
     * Get isDeleted
     *
     * @return boolean
     */
    public function getIsDeleted();

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
     * @return Topic
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
     * @return Topic
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
     * @return Topic
     */
    public function setCategory(Category $category = null);

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory();
}

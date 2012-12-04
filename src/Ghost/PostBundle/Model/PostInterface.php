<?php
namespace Ghost\PostBundle\Model;

use Ghost\UserBundle\Model\User;

/**
 * Post Interface
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface PostInterface
{
    /**
     * Set body
     *
     * @param string $body
     *
     * @return Post
     */
    public function setBody($body);

    /**
     * Get body
     *
     * @return string
     */
    public function getBody();

    /**
     * @param string $rawBody
     *
     * @return self
     */
    public function setRawBody($rawBody);

    /**
     * @return string
     */
    public function getRawBody();

    /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return Post
     */
    public function setIsDeleted($isDeleted);

    /**
     * Get isDeleted
     *
     * @return boolean
     */
    public function isDeleted();

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return Post
     */
    public function setCreated($created);

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated();

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Post
     */
    public function setUser(User $user = null);

    /**
     * Get user
     *
     * @return User
     */
    public function getUser();

    /**
     * Set topic
     *
     * @param Topic $topic
     *
     * @return Post
     */
    public function setTopic(Topic $topic = null);

    /**
     * Get topic
     *
     * @return Topic
     */
    public function getTopic();
}

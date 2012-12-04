<?php
namespace Ghost\PostBundle\Model;

use Ghost\UserBundle\Model\User;

/**
 * Post Model
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
abstract class Post implements PostInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var string $body
     */
    protected $body;

    /**
     * @var string
     */
    protected $rawBody;

    /**
     * @var boolean $isDeleted
     */
    protected $isDeleted = false;

    /**
     * @var integer $created
     */
    protected $created;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Topic
     */
    protected $topic;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->created = time();
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
    public function setRawBody($rawBody)
    {
        $this->rawBody = $rawBody;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRawBody()
    {
        return $this->rawBody ? $this->rawBody : $this->getBody();
    }


    /**
     * {@inheritDoc}
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

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
    public function setCreated($created)
    {
        $this->created = (boolean)$created;

        return $this;
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
    public function setTopic(Topic $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTopic()
    {
        return $this->topic;
    }
}
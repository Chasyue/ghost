<?php
namespace Ghost\PostBundle\Event;

use Ghost\PostBundle\Model\PostInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostEvent extends TopicEvent
{
    private $post;

    public function __construct(PostInterface $post)
    {
        parent::__construct($post->getTopic());

        $this->post = $post;
    }

    public function getPost()
    {
        return $this->post;
    }
}
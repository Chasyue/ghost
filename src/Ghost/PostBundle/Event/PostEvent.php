<?php
namespace Ghost\PostBundle\Event;

use Ghost\PostBundle\Entity\Post;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostEvent extends TopicEvent
{
    private $post;

    public function __construct(Post $post)
    {
        parent::__construct($post->getTopic());

        $this->post = $post;
    }

    public function getPost()
    {
        return $this->post;
    }
}
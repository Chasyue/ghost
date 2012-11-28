<?php
namespace Ghost\PostBundle\Security;

use Ghost\PostBundle\Entity\Topic;
use Ghost\PostBundle\Entity\Post;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface AuthorizerInterface
{
    /**
     * Checks if the user should be able to edit a topic.
     *
     * @param Topic $topic
     *
     * @return boolean
     */
    public function canEditTopic(Topic $topic);

    /**
     * Checks if the user should be able to delete a topic.
     *
     * @param Topic $topic
     *
     * @return boolean
     */
    public function canDeleteTopic(Topic $topic);

    /**
     * Checks if the user should be able to edit a post.
     *
     * @param Post $post
     *
     * @return boolean
     */
    public function canEditPost(Post $post);

    /**
     * Checks if the user should be able to delete a post.
     *
     * @param Post $post
     *
     * @return boolean
     */
    public function canDeletePost(Post $post);
}
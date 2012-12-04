<?php
namespace Ghost\PostBundle\ModelManager;

use Ghost\PostBundle\Model\TopicInterface;
use Ghost\PostBundle\Model\PostInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface PostManagerInterface
{
    /**
     * @return PostInterface
     */
    public function createPost();

    /**
     * @param integer $id
     *
     * @return PostInterface
     */
    public function findPost($id);

    /**
     * @return array of post
     */
    public function findAllPosts();

    /**
     * @param TopicInterface $topic
     * @param integer $page
     *
     * @return array of post
     */
    public function findPostsByTopic(TopicInterface $topic, $page = 1);

    /**
     * @param PostInterface $post
     */
    public function savePost(PostInterface $post);

    /**
     * @param PostInterface $post
     */
    public function deletePost(PostInterface $post);

    /**
     * @param PostInterface $post
     *
     * @return bool
     */
    public function isNewPost(PostInterface $post);

    /**
     * @return string
     */
    public function getClass();
}

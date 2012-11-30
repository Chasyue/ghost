<?php
namespace Ghost\PostBundle\ModelManager;

use Ghost\PostBundle\Model\TopicInterface;
use Ghost\PostBundle\Model\CategoryInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface TopicManagerInterface
{
    /**
     * @return TopicInterface
     */
    public function createTopic();

    /**
     * @param integer $id
     *
     * @return TopicInterface
     */
    public function findTopic($id);

    /**
     * @return array of topic
     */
    public function findAllTopics();

    /**
     * @param integer $page
     *
     * @return array of topic
     */
    public function findTopics($page = 1);

    /**
     * @param CategoryInterface $category
     * @param integer $page
     *
     * @return array of topic
     */
    public function findTopicsByCategory(CategoryInterface $category, $page = 1);

    /**
     * @param TopicInterface $topic
     */
    public function saveTopic(TopicInterface $topic);

    /**
     * @param TopicInterface $topic
     */
    public function deleteTopic(TopicInterface $topic);

    /**
     * @param TopicInterface $topic
     */
    public function incrementViewsCount(TopicInterface $topic);

    /**
     * @param TopicInterface $topic
     *
     * @return bool
     */
    public function isNewTopic(TopicInterface $topic);

    /**
     * @return string
     */
    public function getClass();
}

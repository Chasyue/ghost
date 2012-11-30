<?php
namespace Ghost\PostBundle\Acl;

use Ghost\PostBundle\ModelManager\TopicManagerInterface;
use Ghost\PostBundle\Model\CategoryInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Ghost\PostBundle\Model\TopicInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class AclTopicManager implements TopicManagerInterface
{
    /**
     * @var TopicManagerInterface
     */
    protected $realManager;

    /**
     * @var TopicAclInterface
     */
    protected $topicAcl;

    /**
     * @param TopicManagerInterface $realManager
     * @param TopicAclInterface     $acl
     */
    public function __construct(TopicManagerInterface $realManager, TopicAclInterface $acl)
    {
        $this->realManager = $realManager;
        $this->topicAcl    = $acl;
    }

    /**
     * {@inheritDoc}
     */
    public function createTopic()
    {
        return $this->realManager->createTopic();
    }

    /**
     * {@inheritDoc}
     */
    public function findTopic($id)
    {
        $topic = $this->realManager->findTopic($id);

        if (!$this->topicAcl->canView($topic)) {
            throw new AccessDeniedException();
        }

        return $topic;
    }

    /**
     * {@inheritDoc}
     */
    public function findAllTopics()
    {
        $topics = $this->realManager->findAllTopics();

        foreach ($topics as $topic) {
            if (!$this->topicAcl->canView($topic)) {
                throw new AccessDeniedException();
            }
        }

        return $topics;
    }

    /**
     * {@inheritDoc}
     */
    public function findTopics($page = 1)
    {
        $topics = $this->realManager->findTopics($page);

        foreach ($topics as $topic) {
            if (!$this->topicAcl->canView($topic)) {
                throw new AccessDeniedException();
            }
        }

        return $topics;
    }

    /**
     * {@inheritDoc}
     */
    public function findTopicsByCategory(CategoryInterface $category, $page = 1)
    {
        $topics = $this->realManager->findTopicsByCategory($category, $page);

        foreach ($topics as $topic) {
            if (!$this->topicAcl->canView($topic)) {
                throw new AccessDeniedException();
            }
        }

        return $topics;
    }

    /**
     * {@inheritDoc}
     */
    public function saveTopic(TopicInterface $topic)
    {
        if (!$this->topicAcl->canCreate()) {
            throw new AccessDeniedException();
        }

        $newTopic = $this->isNewTopic($topic);

        if (!$newTopic && !$this->topicAcl->canEdit($topic)) {
            throw new AccessDeniedException();
        }

        $this->realManager->saveTopic($topic);

        if ($newTopic) {
            $this->topicAcl->setDefaultAcl($topic);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function deleteTopic(TopicInterface $topic)
    {
        if (!$this->topicAcl->canDelete($topic)) {
            throw new AccessDeniedException();
        }

        $this->realManager->deleteTopic($topic);
    }

    /**
     * {@inheritDoc}
     */
    public function incrementViewsCount(TopicInterface $topic)
    {
        $this->realManager->incrementViewsCount($topic);
    }

    /**
     * {@inheritDoc}
     */
    public function isNewTopic(TopicInterface $topic)
    {
        return $this->realManager->isNewTopic($topic);
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->realManager->getClass();
    }
}

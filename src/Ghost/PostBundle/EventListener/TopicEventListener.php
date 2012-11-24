<?php
namespace Ghost\PostBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Ghost\PostBundle\Event\TopicEvent;
use Ghost\PostBundle\EntityManager\TopicManager;
use Ghost\PostBundle\Event\Events;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class TopicEventListener implements EventSubscriberInterface
{
    /**
     * @var TopicManager
     */
    private $topicManager;

    /**
     * @param TopicManager $topicManager
     */
    public function __construct(TopicManager $topicManager)
    {
        $this->topicManager = $topicManager;
    }

    /**
     * @param TopicEvent $event
     */
    public function onTopicPersist(TopicEvent $event)
    {
        $topic = $event->getTopic();

        if (!$this->topicManager->isNewTopic($topic)) {
            return;
        }

        $topic->getCategory()->incrementTopicsCount();
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            Events::TOPIC_PRE_PERSIST => 'onTopicPersist'
        );
    }
}

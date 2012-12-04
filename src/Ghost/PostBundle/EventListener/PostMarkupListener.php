<?php
namespace Ghost\PostBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Ghost\PostBundle\Markup\MarkupHelper;
use Ghost\PostBundle\Event\TopicEvent;
use Ghost\PostBundle\Event\PostEvent;
use Ghost\PostBundle\Event\Events;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostMarkupListener implements EventSubscriberInterface
{
    /**
     * @var MarkupHelper
     */
    private $helper;

    /**
     * @param MarkupHelper $helper
     */
    public function __construct(MarkupHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @param PostEvent $event
     */
    public function onPostPersist(PostEvent $event)
    {
        $post   = $event->getPost();
        $result = $this->helper->transform($post->getBody());
        $post->setRawBody($result);
    }

    /**
     * @param TopicEvent $event
     */
    public function onTopicPersist(TopicEvent $event)
    {
        $topic  = $event->getTopic();
        $result = $this->helper->transform($topic->getBody());
        $topic->setRawBody($result);
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            Events::POST_PRE_PERSIST  => 'onPostPersist',
            Events::TOPIC_PRE_PERSIST => 'onTopicPersist'
        );
    }
}
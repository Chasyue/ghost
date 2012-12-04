<?php
namespace Ghost\PostBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Ghost\PostBundle\Event\TopicEvent;
use Ghost\PostBundle\Event\PostEvent;
use Ghost\PostBundle\Markup\ParserInterface;
use Ghost\PostBundle\Event\Events;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostMarkupListener implements EventSubscriberInterface
{
    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @param ParserInterface $parser
     */
    public function __construct(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param PostEvent $event
     */
    public function onPostPersist(PostEvent $event)
    {
        $post   = $event->getPost();
        $result = $this->parser->parse($post->getBody());
        $post->setRawBody($result);
    }

    /**
     * @param TopicEvent $event
     */
    public function onTopicPersist(TopicEvent $event)
    {
        $topic  = $event->getTopic();
        $result = $this->parser->parse($topic->getBody());
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
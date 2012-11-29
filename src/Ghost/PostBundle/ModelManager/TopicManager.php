<?php
namespace Ghost\PostBundle\ModelManager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Ghost\PostBundle\Model\TopicInterface;
use Ghost\PostBundle\Event\Events;
use Ghost\PostBundle\Event\TopicEvent;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
abstract class TopicManager implements TopicManagerInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param EventDispatcherInterface         $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritDoc}
     */
    public function createTopic()
    {
        $class = $this->getClass();
        $topic = new $class;

        return $topic;
    }

    /**
     * {@inheritDoc}
     */
    public function saveTopic(TopicInterface $topic)
    {
        $this->dispatcher->dispatch(Events::TOPIC_PRE_PERSIST, new TopicEvent($topic));

        $this->doSaveTopic($topic);

        $this->dispatcher->dispatch(Events::TOPIC_PERSIST, new TopicEvent($topic));
    }

    /**
     * {@inheritDoc}
     */
    public function deleteTopic(TopicInterface $topic)
    {
        $this->doDeleteTopic($topic);

        $this->dispatcher->dispatch(Events::TOPIC_DELETE, new TopicEvent($topic));
    }

    abstract public function doDeleteTopic(TopicInterface $topic);

    abstract public function doSaveTopic(TopicInterface $topic);
}

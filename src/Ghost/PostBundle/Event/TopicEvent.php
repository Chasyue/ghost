<?php
namespace Ghost\PostBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Ghost\PostBundle\Model\TopicInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class TopicEvent extends Event
{
    private $topic;

    public function __construct(TopicInterface $topic)
    {
        $this->topic = $topic;
    }

    public function getTopic()
    {
        return $this->topic;
    }
}
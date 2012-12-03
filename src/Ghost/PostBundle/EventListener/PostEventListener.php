<?php
namespace Ghost\PostBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Ghost\PostBundle\Event\PostEvent;
use Ghost\PostBundle\EntityManager\PostManager;
use Ghost\PostBundle\Event\Events;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostEventListener implements EventSubscriberInterface
{
    /**
     * @var PostManager
     */
    private $postManager;

    /**
     * @param PostManager $postManager
     */
    public function __construct(PostManager $postManager)
    {
        $this->postManager = $postManager;
    }

    /**
     * @param PostEvent $event
     */
    public function onPostPersist(PostEvent $event)
    {
        $post = $event->getPost();

        if (!$this->postManager->isNewPost($post)) {
            return;
        }

        $topic = $event->getTopic();
        $topic->setLastUpdated($post->getCreated());
        $topic->setLastPoster($post->getUser()->getUsername());
        $topic->incrementRepliesCount();
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            Events::POST_PRE_PERSIST => 'onPostPersist'
        );
    }
}

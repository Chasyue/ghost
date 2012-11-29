<?php
namespace Ghost\PostBundle\ModelManager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Ghost\PostBundle\Model\PostInterface;
use Ghost\PostBundle\Event\PostEvent;
use Ghost\PostBundle\Event\Events;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
abstract class PostManager implements PostManagerInterface
{

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param EventDispatcherInterface     $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritDoc}
     */
    public function createPost()
    {
        $class = $this->getClass();
        $post  = new $class;

        return $post;
    }

    /**
     * {@inheritDoc}
     */
    public function savePost(PostInterface $post)
    {
        $this->dispatcher->dispatch(Events::POST_PRE_PERSIST, new PostEvent($post));

        $this->doSavePost($post);

        $this->dispatcher->dispatch(Events::POST_PERSIST, new PostEvent($post));
    }

    /**
     * {@inheritDoc}
     */
    public function deletePost(PostInterface $post)
    {
        $this->doDeletePost($post);

        $this->dispatcher->dispatch(Events::POST_DELETE, new PostEvent($post));
    }


    abstract public function doSavePost(PostInterface $post);

    abstract public function doDeletePost(PostInterface $post);
}

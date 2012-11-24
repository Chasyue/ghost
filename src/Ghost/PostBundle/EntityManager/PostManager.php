<?php
namespace Ghost\PostBundle\EntityManager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Ghost\PostBundle\Entity\Topic;
use Ghost\PostBundle\Event\PostEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Ghost\PostBundle\Entity\Post;
use Ghost\PostBundle\Event\Events;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var string
     */
    private $class;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param EventDispatcherInterface     $dispatcher
     * @param EntityManager                $em
     * @param string                       $class
     */
    public function __construct(EventDispatcherInterface $dispatcher, EntityManager $em, $class)
    {
        $this->dispatcher = $dispatcher;
        $this->em         = $em;
        $this->repository = $em->getRepository($class);
        $this->class      = $em->getClassMetadata($class)->getName();
    }

    /**
     * @return Post
     */
    public function createPost()
    {
        $post = new $this->class;

        return $post;
    }

    /**
     * @param integer $id
     *
     * @return Post
     */
    public function findPost($id)
    {
        return $this->repository->findOneBy(array('id' => $id, 'isDeleted' => 0));
    }

    /**
     * @param Topic $topic
     *
     * @return array of post
     */
    public function findPostByTopic(Topic $topic)
    {
        $qb = $this->repository->createQueryBuilder('p')
            ->select('p, t, u')
            ->join('p.topic', 't')
            ->join('p.user', 'u')
            ->where('t.id = :topic')
            ->andWhere('p.isDeleted = 0')
            ->setParameter('topic', $topic->getId());

        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * @param Post $post
     */
    public function savePost(Post $post)
    {
        $this->dispatcher->dispatch(Events::POST_PRE_PERSIST, new PostEvent($post));

        $this->em->persist($post);
        $this->em->flush();

        $this->dispatcher->dispatch(Events::POST_PERSIST, new PostEvent($post));
    }

    /**
     * @param Post $post
     */
    public function deletePost(Post $post)
    {
        $post->setIsDeleted(true);
        $this->em->persist($post);
        $this->em->flush();

        $this->dispatcher->dispatch(Events::POST_DELETE, new PostEvent($post));
    }

    /**
     * @param Post $post
     *
     * @return bool
     */
    public function isNewPost(Post $post)
    {
        return !$this->em->getUnitOfWork()->isInIdentityMap($post);
    }
}

<?php
namespace Ghost\PostBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Ghost\PostBundle\Model\TopicInterface;
use Ghost\PostBundle\Model\PostInterface;
use Ghost\PostBundle\ModelManager\PostManager as BasePostManager;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class PostManager extends BasePostManager
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
     * @param EventDispatcherInterface     $dispatcher
     * @param EntityManager                $em
     * @param string                       $class
     */
    public function __construct(EventDispatcherInterface $dispatcher, EntityManager $em, $class)
    {
        parent::__construct($dispatcher);

        $this->em         = $em;
        $this->repository = $em->getRepository($class);
        $this->class      = $em->getClassMetadata($class)->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function findPost($id)
    {
        return $this->repository->findOneBy(array('id' => $id, 'isDeleted' => 0));
    }

    /**
     * {@inheritDoc}
     */
    public function findPostByTopic(TopicInterface $topic)
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
     * {@inheritDoc}
     */
    public function doSavePost(PostInterface $post)
    {
        $this->em->persist($post);
        $this->em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function doDeletePost(PostInterface $post)
    {
        $post->setIsDeleted(true);
        $this->em->persist($post);
        $this->em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function isNewPost(PostInterface $post)
    {
        return !$this->em->getUnitOfWork()->isInIdentityMap($post);
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }
}

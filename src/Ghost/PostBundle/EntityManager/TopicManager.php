<?php
namespace Ghost\PostBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Ghost\PostBundle\Model\TopicInterface;
use Ghost\PostBundle\Model\CategoryInterface;
use Ghost\PostBundle\ModelManager\TopicManager as BaseTopicManager;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class TopicManager extends BaseTopicManager
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
     * @param EventDispatcherInterface         $dispatcher
     * @param EntityManager                    $em
     * @param string                           $class
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
    public function findTopic($id)
    {
        return $this->repository->findOneBy(array('id' => $id, 'isDeleted' => 0));
    }

    /**
     * {@inheritDoc}
     */
    public function findAllTopic()
    {
        return $this->repository->findBy(array('isDeleted' => 0));
    }

    /**
     * {@inheritDoc}
     */
    public function findTopicByCategory(CategoryInterface $category)
    {
        $qb = $this->repository->createQueryBuilder('t')
            ->select('t, c, u')
            ->join('t.category', 'c')
            ->join('t.user', 'u')
            ->where('c.id = :category')
            ->andWhere('t.isDeleted = 0')
            ->setParameter('category', $category->getId());

        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function doSaveTopic(TopicInterface $topic)
    {
        $this->em->persist($topic);
        $this->em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function doDeleteTopic(TopicInterface $topic)
    {
        $topic->setIsDeleted(true);
        $this->em->persist($topic);
        $this->em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function incrementViewsCount(TopicInterface $topic)
    {
        $topic->incrementViewsCount();
        $this->em->persist($topic);
        $this->em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function isNewTopic(TopicInterface $topic)
    {
        return !$this->em->getUnitOfWork()->isInIdentityMap($topic);
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }
}

<?php
namespace Ghost\PostBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\EntityRepository;
use Ghost\PostBundle\Entity\Category;
use Ghost\PostBundle\Entity\Topic;
use Ghost\PostBundle\Event\Events;
use Ghost\PostBundle\Event\TopicEvent;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class TopicManager
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
     * @param EventDispatcherInterface         $dispatcher
     * @param EntityManager                    $em
     * @param string                           $class
     */
    public function __construct(EventDispatcherInterface $dispatcher, EntityManager $em, $class)
    {
        $this->em         = $em;
        $this->repository = $em->getRepository($class);
        $this->class      = $em->getClassMetadata($class)->getName();
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return Topic
     */
    public function createTopic()
    {
        $topic = new $this->class;

        return $topic;
    }

    /**
     * @param integer $id
     *
     * @return Topic
     */
    public function findTopic($id)
    {
        return $this->repository->findOneBy(array('id' => $id, 'isDeleted' => 0));
    }

    /**
     * @return array of topic
     */
    public function findAllTopic()
    {
        return $this->repository->findBy(array('isDeleted' => 0));
    }

    /**
     * @param Category $category
     *
     * @return array of topic
     */
    public function findTopicByCategory(Category $category)
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
     * @param Topic $topic
     */
    public function saveTopic(Topic $topic)
    {
        $this->dispatcher->dispatch(Events::TOPIC_PRE_PERSIST, new TopicEvent($topic));

        $this->em->persist($topic);
        $this->em->flush();

        $this->dispatcher->dispatch(Events::TOPIC_PERSIST, new TopicEvent($topic));
    }

    /**
     * @param Topic $topic
     */
    public function deleteTopic(Topic $topic)
    {
        $topic->setIsDeleted(true);
        $this->em->persist($topic);
        $this->em->flush();

        $this->dispatcher->dispatch(Events::TOPIC_DELETE, new TopicEvent($topic));
    }

    /**
     * @param Topic $topic
     */
    public function incrementViewsCount(Topic $topic)
    {
        $topic->incrementViewsCount();
        $this->em->persist($topic);
        $this->em->flush();
    }

    /**
     * @param Topic $topic
     *
     * @return bool
     */
    public function isNewTopic(Topic $topic)
    {
        return !$this->em->getUnitOfWork()->isInIdentityMap($topic);
    }
}

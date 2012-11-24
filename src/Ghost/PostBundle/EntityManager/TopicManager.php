<?php
namespace Ghost\PostBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Ghost\PostBundle\Entity\Category;
use Ghost\PostBundle\Entity\Topic;

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
     * @param EntityManager               $em
     * @param                             $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em         = $em;
        $this->repository = $em->getRepository($class);
        $this->class      = $em->getClassMetadata($class)->getName();
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
        return $this->repository->find($id);
    }

    /**
     * @return array of topic
     */
    public function findAllTopic()
    {
        return $this->repository->findAll();
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
            ->setParameter('category', $category->getId());

        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * @param Topic $topic
     */
    public function saveTopic(Topic $topic)
    {
        $this->em->persist($topic);
        $this->em->flush();
    }

    /**
     * @param Topic $topic
     */
    public function deleteTopic(Topic $topic)
    {
        $topic->setIsDeleted(true);
        $this->em->persist($topic);
        $this->em->flush();
    }
}

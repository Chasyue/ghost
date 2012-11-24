<?php
namespace Ghost\PostBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Ghost\PostBundle\Entity\Category;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class CategoryManager
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
     * @param string $alias
     *
     * @return Category
     */
    public function findCategoryByAlias($alias)
    {
        return $this->repository->findOneBy(array('alias' => $alias));
    }
}

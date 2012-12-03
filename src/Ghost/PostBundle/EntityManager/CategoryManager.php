<?php
namespace Ghost\PostBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Ghost\PostBundle\ModelManager\CategoryManager as BaseCategoryManager;
use Ghost\PostBundle\Model\CategoryInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class CategoryManager extends BaseCategoryManager
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
     * @return CategoryInterface
     */
    public function findCategoryByAlias($alias)
    {
        return $this->repository->findOneBy(array('alias' => $alias));
    }

    /**
     * @return array of categories
     */
    public function findAllCategories()
    {
        return $this->repository->findAll();
    }
}

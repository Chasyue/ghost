<?php
namespace Ghost\PostBundle\Model;

/**
 * Category entity
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
abstract class Category implements CategoryInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $alias
     */
    protected $alias;

    /**
     * @var integer $topicsCount
     */
    protected $topicsCount = 0;

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * {@inheritDoc}
     */
    public function getTopicsCount()
    {
        return $this->topicsCount;
    }

    /**
     * {@inheritDoc}
     */
    public function incrementTopicsCount($by = 1)
    {
        $this->topicsCount += intval($by);

        return $this;
    }
}

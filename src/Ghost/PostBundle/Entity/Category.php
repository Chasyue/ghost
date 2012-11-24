<?php
namespace Ghost\PostBundle\Entity;

/**
 * Category entity
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
class Category
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $alias
     */
    private $alias;

    /**
     * @var integer $topicsCount
     */
    private $topicsCount;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Category
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set topicsCount
     *
     * @param integer $topicsCount
     *
     * @return Category
     */
    public function setTopicsCount($topicsCount)
    {
        $this->topicsCount = $topicsCount;

        return $this;
    }

    /**
     * Get topicsCount
     *
     * @return integer
     */
    public function getTopicsCount()
    {
        return $this->topicsCount;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}

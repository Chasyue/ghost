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
    private $topicsCount = 0;

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

    /**
     * @param int $by
     *
     * @return Category
     */
    public function incrementTopicsCount($by = 1)
    {
        $this->topicsCount += intval($by);

        return $this;
    }
}

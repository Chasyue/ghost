<?php
namespace Ghost\PostBundle\Model;

/**
 * Category Interface
 *
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface CategoryInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Category
     */
    public function setAlias($alias);

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias();

    /**
     * Get topicsCount
     *
     * @return integer
     */
    public function getTopicsCount();

    /**
     * @param int $by
     *
     * @return Category
     */
    public function incrementTopicsCount($by = 1);
}

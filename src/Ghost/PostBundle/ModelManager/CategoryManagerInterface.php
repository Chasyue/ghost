<?php
namespace Ghost\PostBundle\ModelManager;

use Ghost\PostBundle\Model\CategoryInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
interface CategoryManagerInterface
{
    /**
     * @param string $alias
     *
     * @return CategoryInterface
     */
    public function findCategoryByAlias($alias);

    /**
     * @return array of categories
     */
    public function findAllCategories();
}

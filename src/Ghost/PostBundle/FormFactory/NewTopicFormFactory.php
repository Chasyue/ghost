<?php
namespace Ghost\PostBundle\FormFactory;

use Ghost\PostBundle\Entity\Category;
use Symfony\Component\Form\Form;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class NewTopicFormFactory extends AbstractFormFactory
{
    /**
     * Creates a form
     *
     * @param Category $category
     *
     * @return Form
     */
    public function createForm(Category $category)
    {
        $topic = $this->createModelInstance();
        $topic->setCategory($category);

        $builder = $this->formFactory->createBuilder($this->type, $topic);

        return $builder->getForm();
    }
}
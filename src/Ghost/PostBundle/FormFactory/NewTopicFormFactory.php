<?php
namespace Ghost\PostBundle\FormFactory;

use Ghost\PostBundle\Entity\Category;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\AbstractType;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class NewTopicFormFactory
{
    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @var AbstractType
     */
    protected $type;

    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @param FormFactoryInterface                         $formFactory
     * @param AbstractType                                 $type
     * @param string                                       $modelClass
     */
    public function __construct(FormFactoryInterface $formFactory, AbstractType $type, $modelClass = null)
    {
        $this->formFactory = $formFactory;
        $this->type        = $type;
        $this->modelClass  = $modelClass;
    }

    /**
     * Creates a form
     *
     * @param Category $category
     *
     * @return Form
     */
    public function createForm(Category $category)
    {
        $topic = new $this->modelClass;
        $topic->setCategory($category);

        $builder = $this->formFactory->createBuilder($this->type, $topic);

        return $builder->getForm();
    }
}
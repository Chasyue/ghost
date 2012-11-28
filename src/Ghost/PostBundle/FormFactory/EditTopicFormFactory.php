<?php
namespace Ghost\PostBundle\FormFactory;

use Ghost\PostBundle\Entity\Topic;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\AbstractType;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class EditTopicFormFactory
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
     * @param FormFactoryInterface                         $formFactory
     * @param AbstractType                                 $type
     */
    public function __construct(FormFactoryInterface $formFactory, AbstractType $type)
    {
        $this->formFactory = $formFactory;
        $this->type        = $type;
    }

    /**
     * Creates a form
     *
     * @param Topic $topic
     *
     * @return Form
     */
    public function createForm(Topic $topic)
    {
        $builder = $this->formFactory->createBuilder($this->type, $topic);

        return $builder->getForm();
    }
}
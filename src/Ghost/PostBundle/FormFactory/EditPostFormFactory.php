<?php
namespace Ghost\PostBundle\FormFactory;

use Ghost\PostBundle\Entity\Post;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\AbstractType;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class EditPostFormFactory
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
     * @param Post $post
     *
     * @return Form
     */
    public function createForm(Post $post)
    {
        $builder = $this->formFactory->createBuilder($this->type, $post);

        return $builder->getForm();
    }
}
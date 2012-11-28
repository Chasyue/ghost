<?php
namespace Ghost\PostBundle\FormFactory;

use Ghost\PostBundle\Entity\Topic;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\AbstractType;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class NewPostFormFactory
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
     * @param Topic $topic
     *
     * @return Form
     */
    public function createForm(Topic $topic)
    {
        $post = new $this->modelClass;
        $post->setTopic($topic);

        $builder = $this->formFactory->createBuilder($this->type, $post);

        return $builder->getForm();
    }
}
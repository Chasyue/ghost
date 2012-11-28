<?php
namespace Ghost\UserBundle\FormFactory;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\AbstractType;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class AbstractFormFactory
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
     * @return object
     * @throws \RuntimeException
     */
    protected function createModelInstance()
    {
        if (!$this->modelClass) {
            throw new \RuntimeException('The model class is invalid.');
        }

        $model = new $this->modelClass;

        return $model;
    }
}

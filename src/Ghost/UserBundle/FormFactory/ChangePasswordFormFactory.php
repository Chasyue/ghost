<?php
namespace Ghost\UserBundle\FormFactory;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class ChangePasswordFormFactory extends AbstractFormFactory
{
    public function createForm()
    {
        $model = $this->createModelInstance();

        $builder = $this->formFactory->createBuilder($this->type, $model);

        return $builder->getForm();
    }
}
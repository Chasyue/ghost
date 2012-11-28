<?php
namespace Ghost\UserBundle\FormFactory;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class RegistrationFormFactory extends AbstractFormFactory
{
    public function createForm()
    {
        $user = $this->createModelInstance();

        $builder = $this->formFactory->createBuilder($this->type, $user);

        return $builder->getForm();
    }
}

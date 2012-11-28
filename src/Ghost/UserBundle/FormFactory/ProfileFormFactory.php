<?php
namespace Ghost\UserBundle\FormFactory;

use Ghost\UserBundle\Entity\User;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class ProfileFormFactory extends AbstractFormFactory
{
    public function createForm(User $user)
    {
        $builder = $this->formFactory->createBuilder($this->type, $user);

        return $builder->getForm();
    }
}

<?php
namespace Ghost\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Wenming Tang <tang@babyfamily.com>
 */
class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('current', 'password', array(
            'label'              => 'Current password',
            'translation_domain' => 'GhostUserBundle',
            'mapped'             => false,
            'constraints'        => new UserPassword(array('message' => 'ghost_user.currentPassword.mismatch')),
        ));

        $builder->add('new', 'repeated', array(
            'type'            => 'password',
            'options'         => array('translation_domain' => 'GhostUserBundle'),
            'first_options'   => array('label' => 'form.new_password'),
            'second_options'  => array('label' => 'form.new_password_confirmation'),
            'invalid_message' => 'ghost_user.password.mismatch',
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'       => 'Ghost\UserBundle\FormModel\ChangePassword',
            'validation_groups' => array('ChangePassword')
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'edit_password';
    }
}

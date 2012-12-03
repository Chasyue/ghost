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
            'mapped'             => false,
            'constraints'        => new UserPassword(array('message' => 'Current password mismatch')),
        ));

        $builder->add('new', 'repeated', array(
            'type'            => 'password',
            'first_options'   => array('label' => 'New password'),
            'second_options'  => array('label' => 'Confirm password'),
            'invalid_message' => 'Password mismatch',
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'       => 'Ghost\UserBundle\FormModel\ChangePassword',
            'validation_groups' => array('Default', 'ChangePassword')
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

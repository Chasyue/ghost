<?php

namespace Ghost\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('plainPassword', 'repeated', array(
            'type'            => 'password',
            'first_options'   => array('label' => 'Password'),
            'second_options'  => array('label' => 'Confirm password'),
            'invalid_message' => 'Password mismatch'
            ))
            ->add('name', 'text', array('label' => 'Full name'))
            ->add('email', 'email', array('label' => 'Email address'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'       => 'Ghost\UserBundle\Entity\User',
            'validation_groups' => array('Registration')
        ));
    }

    public function getName()
    {
        return 'user';
    }
}

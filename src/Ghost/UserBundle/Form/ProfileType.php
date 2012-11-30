<?php

namespace Ghost\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('name')
            ->add('email');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'       => 'Ghost\UserBundle\Entity\User',
            'validation_groups' => array('Profile')
        ));
    }

    public function getName()
    {
        return 'user';
    }
}

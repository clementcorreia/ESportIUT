<?php

namespace LCSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use LCSBundle\Form\JoueurType;

class UserType extends BaseType;
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('joueur', new JoueurType(), array(
            'label' => ''
        ));
        parent::buildForm($builder, $options);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LCSBundle\Entity\Joueur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lcsbundle_joueur';
    }


}

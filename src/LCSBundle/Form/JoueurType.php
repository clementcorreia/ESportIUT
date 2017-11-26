<?php

namespace LCSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JoueurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pseudo', null, array(
                    'label' => 'Pseudo'
                ))
                ->add('prenom', null, array(
                    'label' => 'Prénom'
                ))
                ->add('nom', null, array(
                    'label' => 'Nom'
                ))
                ->add('description', null, array(
                    'label' => 'Description'
                ))
                ->add('poste', 'entity', array(
                    'label' => 'Poste occupé',
                    'class'     => 'LCSBundle:Poste',
                    'choice_label'  => 'shortname',
                    'multiple'  => false,
                    'expanded'  => false
                ));
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

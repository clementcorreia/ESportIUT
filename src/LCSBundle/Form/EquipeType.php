<?php

namespace LCSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class EquipeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
                ->add('slogan')
                ->add('description')
                ->add('capitaine', 'entity', array(
                    'label'     => 'Capitaine',
                    'class'     => 'LCSBundle:Joueur',
                    'property'  => 'pseudo',
                    'multiple'  => false,
                    'expanded'  => false
                ))
                ->add('joueurs', 'entity', array(
                    'label'     => 'Joueurs',
                    'class'     => 'LCSBundle:Joueur',
                    'property'  => 'pseudo',
                    'multiple'  => true,
                    'expanded'  => false
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LCSBundle\Entity\Equipe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lcsbundle_equipe';
    }


}

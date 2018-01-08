<?php

namespace LCSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatistiqueJoueurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('kills')
                ->add('deaths')
                ->add('assists')
                ->add('degats')
                ->add('controlWard')
                ->add('balisesPlacees')
                ->add('balisesDetruites')
                ->add('cs')
                ->add('gold')
                ->add('champion')
                ->add('poste')
                ->add('manche')
                ->add('joueur', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(                    
                    'choices'   => $options['joueurs'],
                    'choice_value' => function(\LCSBundle\Entity\Joueur $entity = null) {
                        return $entity ? $entity->getId() : '';
                    },
                    'class' => 'LCSBundle:Joueur',
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LCSBundle\Entity\StatistiqueJoueur',
            'joueurs' => array(),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lcsbundle_statistiquejoueur';
    }


}

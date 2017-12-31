<?php

namespace LCSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use LCSBundle\Repository\TourRepository;

class GameType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tour', 'entity', array(
                    'label'     => 'Tour',
                    'query_builder' => function(TourRepository $er) use ($options) {
                        return $er->findTourByCompetitionId($options['competition_id']);
                    },
                    'class'     => 'LCSBundle:Tour',
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
            'data_class' => 'LCSBundle\Entity\Game',
            'competition_id' => 1,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lcsbundle_game';
    }


}

<?php

namespace LCSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('matchRetour', ChoiceType::class, array(
                    'label' => $options['label'],
                    'choice' => array(
                        '1' => $options['yes'],
                        'O' => $options['no'],
                    )
                    'multiple'  => false,
                    'expanded'  => true
                ))
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label' => 'Générer les matchs retours',
            'yes' => 'Oui',
            'no'  => 'Non'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lcsbundle_competition';
    }


}

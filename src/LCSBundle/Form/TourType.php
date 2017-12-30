<?php

namespace LCSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
                ->add('semaine', DateType::class, array(
                    'label' => 'Semaine',                    
                    'data' => new \DateTime(),
                    'widget' => 'single_text',
                    'input'    => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'class'=>'date',
                        'oninvalid' => "setCustomValidity('La date du bon de commande ne doit pas être vide.')",
                        'oninput'  => "try{setCustomValidity('')}catch(e){}"
                    )
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LCSBundle\Entity\Tour'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lcsbundle_tour';
    }


}

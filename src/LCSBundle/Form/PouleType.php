<?php

namespace LCSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PouleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
                ->add('type')
                ->add('competition')
                ->add('equipes', 'entity', array(
                    'label'     => 'Equipes',
                    'class'     => 'LCSBundle:Equipe',
                    'property'  => 'nom',
                    'multiple'  => true,
                    'expanded'  => false,
                    'required'  => false
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LCSBundle\Entity\Poule'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lcsbundle_poule';
    }


}

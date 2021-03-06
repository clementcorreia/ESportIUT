<?php

namespace LCSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', null, array(
                    'label' => 'Nom'
                ))
                ->add('dateDebut', DateType::class, array(
                    'label' => 'Date de début',
                    'widget' => 'single_text',
                    'input'    => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'class'=>'date'
                    )
                ))
                ->add('dateFin', DateType::class, array(
                    'label' => 'Date de fin',
                    'widget' => 'single_text',
                    'input'    => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'required' => false,
                    'attr' => array(
                        'class'=>'date',
                    )
                ))
                ->add('dateLimiteInscription', DateType::class, array(
                    'label' => 'Date limite des inscriptions',
                    'widget' => 'single_text',
                    'input'    => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'required' => false,
                    'attr' => array(
                        'class'=>'date',
                    )
                ))
                ->add('nbEquipeMin', null, array(
                    'label' => 'Nombre d\'équipes min'
                ))
                ->add('nbEquipeMax', null, array(
                    'label' => 'Nombre d\'équipes max'
                ))
                ->add('description', null, array(
                    'label' => 'Description',
                    'attr' => array(
                        'required' => false
                    )
                ))
                /*->add('allowCaptainRegister', null, array(
                    'label' => 'Autoriser les capitaines à inscrire leur équipe',
                    'label_attr' => array(
                        'class' => 'checkbox_form',
                    ),
                    'attr' => array(
                        'required' => false,
                    )
                ))*/
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
            'data_class' => 'LCSBundle\Entity\Competition',
            'afficheEquipes' => false
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

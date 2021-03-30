<?php

namespace EntitiesBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomEquipe')

            ->add('ideProjet',EntityType::class,
                array(
                    'class'=>'EntitiesBundle:Projets',
                    'choice_label'=>'nomProjet',
                    'multiple'=>false
                ))
            ->add('ideScrumMaster')
            ->add('idePerso1')
            ->add('idePerso2')
            ->add('idePerso3')
            ->add('idePerso4')
            ->add('idePerso5')
            ->add('idePerso6')
        ->add('save',SubmitType::class);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EntitiesBundle\Entity\Equipe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'entitiesbundle_equipe';
    }


}

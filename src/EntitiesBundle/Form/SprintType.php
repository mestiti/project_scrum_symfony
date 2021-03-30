<?php

namespace EntitiesBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SprintType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateDebutSprint',DateType::class,[
            'widget'=>'single_text',
            'format'=>'yyyy-MM-dd'
        ])
            ->add('dateFinSprint',DateType::class,[
            'widget'=>'single_text',
            'format'=>'yyyy-MM-dd'
        ])
            ->add('listeUserSrotyBs')->add('description')->add('id_bs',EntityType::class,
                array(
                    'class'=>'EntitiesBundle:BacklogSprint',
                    'choice_label'=>'id_bs',
                    'multiple'=>false
                ))->add('save',SubmitType::class,['attr'=>['formnovalidate'=>'formnovalidate']]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EntitiesBundle\Entity\Sprint'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'entitiesbundle_sprint';
    }


}

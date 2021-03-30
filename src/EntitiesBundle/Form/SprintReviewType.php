<?php

namespace EntitiesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SprintReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('remarqueReviewEquipe')
            ->add('remarqueReviewProductOwner')
            ->add('dateSprintReview' ,DateType::class,['widget' => 'single_text', 'format' => 'yyyy-MM-dd'])
            ->add('ideProjet' , EntityType::class, array('class'=>'EntitiesBundle:Projets','choice_label'=>'nomProjet','multiple'=>false))
            ->add('ideProductOwner' , EntityType::class, array('class'=>'EntitiesBundle:User','choice_label'=>'Nom','multiple'=>false))
            ->add('ideEquipe' , EntityType::class, array('class'=>'EntitiesBundle:Equipe','choice_label'=>'nomEquipe','multiple'=>false))

            ->add('ideSprint', EntityType::class, array('class'=>'EntitiesBundle:Sprint','choice_label'=>'description','multiple'=>false))
            ->add('save',SubmitType::class);
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EntitiesBundle\Entity\SprintReview'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'entitiesbundle_sprintreview';
    }


}

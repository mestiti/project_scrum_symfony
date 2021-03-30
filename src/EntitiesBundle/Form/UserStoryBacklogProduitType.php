<?php

namespace  EntitiesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class UserStoryBacklogProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('userStoryBp',null, array(
            'label' => ' ',
            'attr' => array('placeholder' => 'userStoryBp')))->add('priorityBp',null, array(
            'label' => ' ',
            'attr' => array('placeholder' => 'priority')))->add('ideBacklogFeat',  EntityType::class,
            array('class'=>'EntitiesBundle:BacklogProduit',
                'choice_label'=>'feature',
                'multiple'=>false))->add('captcha', CaptchaType::class, array(
            'width' => 200,
            'height' => 50,
            'length' => 6,
            'invalid_message' =>'Code non compatible',
            'ignore_all_effects'=>true,
            'quality' => 100,
            'text_color' => [
                0 => 0,
                1 => 0,
                2 => 0,
            ],
            'background_color' => [
                0 => 255,
                1 => 255,
                2 => 255,
            ]))->add( 'save', SubmitType::class);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EntitiesBundle\Entity\UserStoryBacklogProduit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'entitiesbundle_userstorybacklogproduit';
    }


}


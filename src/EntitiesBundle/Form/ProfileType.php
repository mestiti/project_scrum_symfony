<?php


namespace EntitiesBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', null, array('label' => 'Nom', 'translation_domain' => 'FOSUserBundle'))
            ->add('prenom', null, array('label' => 'prenom', 'translation_domain' => 'FOSUserBundle'))
            ->add('Address', null, array('label' => 'form.address', 'translation_domain' => 'FOSUserBundle'))

            ->add('email', EmailType::class, array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))

            ->add('numero_tel', null, array('label' => 'form.numero_tel', 'translation_domain' => 'FOSUserBundle','required'=>false))
            ->add('date_naissance', DateType::class, array('label' => 'form.date_naissance',
                'years'=>range(1960,2001),
                'translation_domain' => 'FOSUserBundle'))



        ;

    }


    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }


}
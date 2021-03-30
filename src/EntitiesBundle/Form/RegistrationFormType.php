<?php


namespace EntitiesBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationFormType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', null, array('label' => 'Nom', 'translation_domain' => 'FOSUserBundle'))
            ->add('prenom', null, array('label' => 'prenom', 'translation_domain' => 'FOSUserBundle'))
            ->add('Address', null, array('label' => 'form.address', 'translation_domain' => 'FOSUserBundle'))

            ->add('email', EmailType::class, array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('numero_tel', null, array('label' => 'form.numero_tel', 'translation_domain' => 'FOSUserBundle','required'=>false))
            ->add('image_user', FileType::class, array('label' => 'form.image_user', 'translation_domain' => 'FOSUserBundle'))
            ->add('date_naissance', DateType::class, array('label' => 'form.date_naissance',
                'years'=>range(1960,2001),
                'translation_domain' => 'FOSUserBundle'))



        ;

    }
    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }
}
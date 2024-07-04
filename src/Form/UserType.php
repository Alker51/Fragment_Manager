<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'required' => true,
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passes doivent correspondres.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe', 'class' => 'password-field'],
                'second_options' => ['label' => 'Répéter Mot de passe', 'class' => 'password_field_checker'],
            ])
            ->add('password', PasswordType::class, [
                'required' => true,
                'attr' => ['class' => 'password_field', 'id' => 'passwordField'],
            ])
            ->add('password_Checker',PasswordType::class, [
                'mapped' => false,
                'required' => true,
                'attr' => ['class' => 'password_field_checker', 'id' => 'passwordFieldChecker'],
            ])
            ->add('password_switch', CheckboxType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'password_switch', 'id' => 'password_switch'],
            ])
            ->add('firstName', TextType::class, [
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
            ])
            ->add('adress', TextType::class, [
                'help' => 'Numéro et Rue',
                'required' => true,
            ])
            ->add('zipCode', TextType::class, [
                'required' => true,
            ])
            ->add('city', TextType::class, [
                'required' => true,
            ])
            ->add('phone', TextType::class, [
                'required' => true,
            ])
            ->add('isTempPass', HiddenType::class, ['empty_data' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

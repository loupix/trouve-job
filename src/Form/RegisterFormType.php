<?php

namespace App\Form;

use App\Entity\User\Registered;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder'=>'Nom'],
                'required' => True,
                'constraints' => array(
                    new NotBlank([
                        'message' => 'Merci d\'ajouter votre nom de famille.',
                    ]),
                )
            ])
            ->add('Prenom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder'=>'Prenom'],
                'required' => True,
                'constraints' => array(
                    new NotBlank([
                        'message' => 'Merci d\'ajouter votre prénom.',
                    ]),
                )
            ])
            ->add('Email', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder'=>'Email'],
                'required' => True,
                'constraints' => array(
                    new NotBlank([
                        'message' => 'Merci d\'ajouter votre email.',
                    ]),
                )
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'attr' => ['class' => 'form-check-input'],
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez aeecpter les conditions d`\'utilisation.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['class' => 'form-control', 'placeholder'=>'Password', 'autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'ajouter un mot de passe.',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} characteres.',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Registered::class,
        ]);
    }
}

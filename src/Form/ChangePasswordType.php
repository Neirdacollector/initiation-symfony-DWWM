<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('lastname', TextType::class, [
                'label' => "Nom :",
            'disabled' => true,
            ])

            ->add('firstname', TextType::class, [
                'label' => "Prenom :",
            'disabled' => true,
            ])

            ->add('email', EmailType::class, [
                'label' => "Email :",
            'disabled' => true,
                
            ])
            
            ->add('old_password', PasswordType::class,[
            'label' => 'Mot de passe actuel:',
            'mapped' => false,
            'attr' => [
                'placeholder' => "Entrez votre Mot de passe actuel"
            ]
            ])

        ->add('new_password', RepeatedType::class, [
            'type' => PasswordType::class,
            'label' => 'Mot de passe :',
            'invalid_message' => 'Les mots de passe ne correspondent pas',
            'required' => true,
            'mapped' => false,
            'first_options' => [
                'label' => " Nouveau Mot de passe :",
                'attr' => [
                    'placeholder' => "Entrez votre Mot de passe"
                ]
            ],
            'second_options' => [
                'label' => "Confirmation du nouveau mot de passe :",
                'attr' => [
                    'placeholder' => "Confirmez votre Mot de passe"
                ]
            ],
        ])

            ->add('submit', SubmitType::class, [
                'label' => "Valider"
            ]);
            
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

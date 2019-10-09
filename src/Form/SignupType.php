<?php

namespace App\Form;

use App\Entity\Civilite;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite', EntityType::class, [
                'class' => Civilite::class,
                'choice_label' => 'libelle'
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('telephone', TextType::class, [
                'attr' => [
                    'placeholder' => 'Téléphone',
                    'class' => 'input-phone'
                ]
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'placeholder' => 'Adresse postale'
                ]
            ])
            ->add('complement', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Complément d\'adresse'
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ville'
                ]
            ])
            ->add('cp', TextType::class, [
                'attr' => [
                    'placeholder' => 'Code postal',
                    'class' => 'input-cp'
                ]
            ])
            ->add('date_de_naissance', DateType::class, [
                'format' => 'd / M / y',
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Date de naissance ( JJ / MM / AAAA )',
                    'class' => 'input-date-naiss'
                ],
                'years' => range(date('Y'), 1940)
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Adresse email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'placeholder' => 'Mot de passe'
                    ]
                ],
                'second_options' => [
                    'attr' => [
                        'placeholder' => 'Répeter votre mot de passe'
                    ]
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('mail', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Adresse Mail'
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Message',
                    'rows' => 5
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

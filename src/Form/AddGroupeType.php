<?php

namespace App\Form;

use App\Entity\Groupe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddGroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom du groupe'
                ]
            ])
            ->add('age_min', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Age de départ'
                ]
            ])
            ->add('age_max', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Age de fin'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Groupe::class,
        ]);
    }
}

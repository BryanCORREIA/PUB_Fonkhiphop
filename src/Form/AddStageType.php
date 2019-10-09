<?php

namespace App\Form;

use App\Entity\Stage;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddStageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Description',
                    'rows' => 5
                ]
            ])
            ->add('nbr_pers', NumberType::class, [
                'label' => 'Nombre de personne',
                'attr' => [
                    'placeholder' => 'Nombre de personne'
                ]
            ])
            ->add('age_min', NumberType::class, [
                'label' => 'Age minimum',
                'attr' => [
                    'placeholder' => 'Age minimum'
                ]
            ])
            ->add('age_max', NumberType::class, [
                'label' => 'Age maximum',
                'attr' => [
                    'placeholder' => 'Age maximum'
                ]
            ])
            ->add('privated', CheckboxType::class, [
                'label' => 'Privé',
                'required' => false
            ])
            ->add('style_danse', TextType::class, [
                'attr' => [
                    'placeholder' => 'Style de danse'
                ]
            ])
            ->add('date_start', DateTimeType::class, [
                'label' => 'Date de début',
                'date_format' => 'dd MM yyyy',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                'years' => range(date('Y'), date('Y') + 5)
            ])
            ->add('date_end',  DateTimeType::class, [
                'label' => 'Date de fin',
                'date_format' => 'dd MM yyyy',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                'years' => range(date('Y'), date('Y') + 5)
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'placeholder' => 'Adresse postale',
                    'value' => 'Foyer Rural, Rue division Leclerc'
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ville',
                    'value' => 'Chateau Gontier'
                ]
            ])
            ->add('cp', TextType::class, [
                'attr' => [
                    'placeholder' => 'Code postal',
                    'value' => '53200'
                ]
            ])
            ->add('prix', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Prix ( 00.00 ) €'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\TypeEnv;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddEvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom de l\'événement'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Description',
                    'rows' => 5
                ]
            ])
            ->add('prix', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix ( Laisser vide si gratuit )'
                ]
            ])
            ->add('dateEvent', DateType::class, [
                'label' => 'Date de l\'événement',
                'format' => 'd M y',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                'years' => range(date('Y'), date('Y') + 5)
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'placeholder' => 'Adresse'
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ville'
                ]
            ])
            ->add('cp', TextType::class, [
                'attr' => [
                    'placeholder' => 'Code postal'
                ]
            ])
            ->add('type_env', EntityType::class, [
                'class' => TypeEnv::class,
                'choice_label' => 'libelle',
                'placeholder' => 'Choisir un type d\'événement',
                'label' => 'Type d\'événement'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Groupe;
use App\Entity\Jours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom du cours'
                ]
            ])
            ->add('heure_deb', TimeType::class, [
                'label' => 'Heure de début',
            ])
            ->add('heure_fin', TimeType::class, [
                'label' => 'Heure de fin',
            ])
            ->add('groupe', EntityType::class, [
                'class' => Groupe::class,
                'choice_label' => 'libelle',
                'label' => 'Groupe',
                'placeholder' => 'Choisir un groupe'
            ])
            ->add('jour', EntityType::class, [
                'class' => Jours::class,
                'choice_label' => 'libelle',
                'label' => 'Jour',
                'placeholder' => 'Choisir un jour'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}

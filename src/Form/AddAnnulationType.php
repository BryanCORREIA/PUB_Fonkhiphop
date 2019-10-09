<?php

namespace App\Form;

use App\Entity\Annulation;
use App\Entity\Cours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddAnnulationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_annulation', DateType::class, [
                'label' => 'Date du cours annulé',
                'format' => 'd M y',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                'years' => range(date('Y'), date('Y') + 5)
            ])
            ->add('cour', EntityType::class, [
                'label' => 'Cours',
                'class' => Cours::class,
                'choice_label' => 'libelle',
                'placeholder' => 'Choisir un cours'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annulation::class,
        ]);
    }
}

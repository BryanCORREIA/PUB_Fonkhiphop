<?php

namespace App\Form;

use App\Entity\CategoryInfo;
use App\Entity\Informations;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre de l\'information'
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Message de l\'information',
                    'rows' => 5
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => CategoryInfo::class,
                'choice_label' => 'libelle',
                'label' => 'Catégorie'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Informations::class,
        ]);
    }
}

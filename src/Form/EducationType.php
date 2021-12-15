<?php

namespace App\Form;

use App\Entity\Education;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EducationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'startDate',
                DateType::class,
                [
                    'label' => 'Date de début',
                    'required' => true,
                    'widget' => 'single_text',
                    'attr' => ['class' => 'js-datepicker']
                ]
            )
            ->add(
                'endDate',
                DateType::class,
                [
                    'label' => 'Date de fin',
                    'required' => true,
                    'widget' => 'single_text',
                    'attr' => ['class' => 'js-datepicker']
                ]
            )
            ->add(
                'schoolName',
                TextType::class
            )
            ->add(
                'description',
                TextareaType::class
            )
            ->add(
                'schoolLink',
                TextType::class
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Education::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}

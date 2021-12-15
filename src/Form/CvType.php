<?php

namespace App\Form;

use App\Entity\CV;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user')
            ->add('name');
        $builder
            ->add('image', FileType::class, [
                'label' => 'Ajouter une image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                        ],
                    ]),
                ],
                'attr' => [
                    'class' => 'filename'
                ]
            ]);
        $builder
            ->add('lastName')
            ->add('firstName')
            ->add('birthdate')
            ->add('email')
            ->add('PhoneNumber')
            ->add('adresseStreet')
            ->add('adresseNumberStreet')
            ->add('adressePostalCode')
            ->add('adresseTown')
            ->add(
                'title'
            );

        $builder->add('education', CollectionType::class, [
            'entry_type' => EducationType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'required' => true

        ]);

        $builder->add('skill', CollectionType::class, [
            'entry_type' => SkillType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'required' => true

        ]);

        $builder->add('experience', CollectionType::class, [
            'entry_type' => ExperienceType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'required' => true
        ]);

        $builder->add('interest', CollectionType::class, [
            'entry_type' => InterestType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'required' => true

        ]);

        $builder->add(
            'save',
            SubmitType::class,
            [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'button-save',
                ],
            ]
        );
    }
}

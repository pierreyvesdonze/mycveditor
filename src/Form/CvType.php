<?php

namespace App\Form;

use App\Entity\CV;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Intitulé du CV"
            ]);
        $builder
            ->add('image', FileType::class, [
                'label' => 'Ajouter une image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            "image/png"
                        ],
                    ]),
                ],
                'attr' => [
                    'class' => 'filename'
                ]
            ]);
        $builder
            ->add('lastName', TextType::class, [
                'label' => "Nom de famille"
            ])
            ->add('firstName', TextType::class, [
                'label' => "Prénom"
            ])
            ->add('birthdate', DateType::class,  [
                'label' => "Date d'anniversaire"
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('PhoneNumber', TextType::class, [
                'label' => "Numéro de téléphone"
            ])
            ->add('adresseStreet', TextType::class, [
                'label' => "Addresse, nom de la rue"
            ])
            ->add('adresseNumberStreet', IntegerType::class, [
                'label' => "Addresse, numéro de rue"
            ])
            ->add('adressePostalCode', IntegerType::class, [
                'label' => 'Addresse, code postal'
            ])
            ->add('adresseTown', TextType::class, [
                'label' => "Addresse, Ville"
            ])
            ->add('title', TextType::class, [
                'label' => 'Intitulé du poste'
            ]);

        $builder->add('education', CollectionType::class, [
            'entry_type' => EducationType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'required' => true

        ]);

        $builder->add('skills', CollectionType::class, [
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

        $builder->add('interests', CollectionType::class, [
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

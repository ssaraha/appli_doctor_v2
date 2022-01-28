<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Clinic;
use App\Entity\Languages;
use App\Entity\Speciality;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Vich\UploaderBundle\Form\Type\VichImageType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,//Accepter la suppression de fichier
                'delete_label' => '...',//Label de suppression
                //'download_label' => '...', Afficher le label de telechargement
                //'download_uri' => true, Annuler l'action de telechargement
                'image_uri' => true,
                'imagine_pattern' => 'square_thumbnail_medium',
                'asset_helper' => true,
            ])
            ->add('firstname', TextType::class, [
                    'label' => false, 
                    'attr' => ['placeholder' => 'Votre nom']

                ])
            ->add('lastname', null, [
                'label' => false, 
                'attr' => ['placeholder' => 'Votre prénom'],
            ])
            ->add('email', null, [
                'label' => false,
                'attr' => ['placeholder' => 'Votre adresse email']
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Accepter nos conditions', 
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => false,
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Votre mot de passe'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champs ne doit pas être vide.',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} charactères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('adresses', null, [
                'label' => false,
                'attr' => ['placeholder' => 'Votre adresse']
            ])
            ->add('is_practitioner', CheckboxType::class, [
                'label' => 'Êtes vos médecin',
                'required'   => false,
            ])
            ->add('speciality', EntityType::class, [
                'placeholder' => 'Choisissez votre clinique',
                'label' => false,
                'required'   => false,
                'class'=> Speciality::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('clinic', EntityType::class, [
                'placeholder' => 'Choisissez votre clinique',
                'label' => false,
                'required'   => false,
                'class'=> Clinic::class,
                'choice_label' => 'name'
            ])
            ->add('languages', EntityType::class, [
                'placeholder' => 'Choisissez votre clinique',
                'label' => false,

                'required'   => false,
                'class'=> Languages::class,
                'choice_label' => 'language', 
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

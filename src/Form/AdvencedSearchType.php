<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AdvencedSearchType extends AbstractType{



    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('Rechercher', TextType::class)
            ->add('Selectionner_un_ou_plusieurs_champs_de_recherche', ChoiceType::class,[
                'choices' => [
                    'Formateur' => 'formateur',
                    // 'Session' => 'fession',
                    // 'Module' => 'module',
                    // 'Stagiaire' => 'stagiaire',
                    // 'Catégorie' => 'categorie',
                ],

             'multiple' => false,
             'expanded' => true
        ])

            ->add('Date_de_debut',DateType::class)
            ->add('Date_de_fin',DateType::class)
            ->add('Valider', SubmitType::class);

            


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }




}


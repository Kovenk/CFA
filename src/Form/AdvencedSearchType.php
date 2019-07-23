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
            ->add('recherche', TextType::class)
            ->add('type', ChoiceType::class,[
                'choices' => [
                    'Formateur' => 'formateur',
                    'Session' => 'session',
                    'Module' => 'module',
                    'Stagiaire' => 'stagiaire',
                    'Catégorie' => 'categorie',
                ],

             'multiple' => false,
             'expanded' => true
        ])

            ->add('begindate',DateType::class)
            ->add('enddate', DateType::class)
            ->add('Valider', SubmitType::class);

            


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }




}


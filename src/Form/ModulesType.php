<?php

namespace App\Form;

use App\Entity\Duree;
use App\Entity\Module;
use App\Entity\Session;
use App\Form\DureeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ModulesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('compositionModule', CollectionType::class, [
                'label' => false,
                "entry_type" => DureeType::class,
                "entry_options" => [
                   
                    'label' => "Module et durée :",
                    ],                
                // "entry_type" => IntegerType::class,
                // "entry_options" => [
                //     'class' => Duree::class,
                //     'label' =>false,
                //     'placeholder' => 'Nombres de jours'
                //     ],
                "allow_add" => true,
                "allow_delete" => true,
                "by_reference" => false
            ])

            ->add('Valider',SubmitType::class)
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}

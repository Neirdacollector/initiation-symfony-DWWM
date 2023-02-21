<?php

namespace App\Form;

use App\Classe\Search;
use App\Entity\Category;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver -> setDefaults([
            'data_class' => Search::class,
            'method' => 'GET'
        ]);
    }

    public function getBlockPrefix()
    {
        return "";
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('string', TextType::class,[
            'required' => false,
            'attr' => [
                'placeholder' => "La recherche"
            ]
        ])

        ->add('categories', EntityType::class, [
            'required' => false,
            'class' => Category::class,
            'multiple' => true,
            'expanded' => true
        ])  
        
        ->add('submit',SubmitType::class, [
            'label' => "Valider"
        ]);
        
    }
}
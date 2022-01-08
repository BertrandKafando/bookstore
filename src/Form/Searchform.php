<?php

namespace App\Form;

use App\Data\Searchdata;
use App\Entity\Auteur;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Searchform extends    AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
          ->add('q',TextType::class, [
              'label'=> false,
              'required'=>false,
              'attr'=>[
                  'placeholder'=>'Rechercher'
              ]
              ])
          ->add('genres',EntityType::class,[
              'label'=>false,
              'required'=>false,
              'class'=>Genre::class,
              'expanded'=>true,
              'multiple'=>true
          ])
          ->add('min',NumberType::class,[
              'label'=>false,
              'required'=>false,
              'attr'=>[
                  'placeholder'=>'notemin'
              ]
          ])

          ->add('max',NumberType::class,[
              'label'=>false,
              'required'=>false,
              'attr'=>[
                  'placeholder'=>'notemax'
              ]
          ])
         ->add('auteurs',EntityType::Class,[
             'label'=>false,
             'required'=>false,
             'class'=>Auteur::class,
             'expanded'=>true,
             'multiple'=>true
         ])

      ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
           'data_class'=> Searchdata::class,
           'method'=>'Get',
           'csrf_protection'=>false
       ])
           ;
    }



    public function getBlockPrefix()
    {
      return '';
    }
}
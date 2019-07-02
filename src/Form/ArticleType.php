<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title' )
            ->add('description')
            ->add('author')
            ->add('editor')
            ->add('state')
            ->add('date_added', DateType::class)
            ->add('integral',CheckboxType::class, array('required' => false))
            ->add('price')
            ->add('genre')
            ->add('genre', ChoiceType::class,[
                'choices' => [
                    'Shojo' => 'Shojo',
                    'Shonen' => 'Shonen',
                    'Seinen' => 'Seinen',
                    'Josei' => 'Josei',
                    'Sempai' => 'Sempai',
                ]
            ])
//            ->add('id_user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

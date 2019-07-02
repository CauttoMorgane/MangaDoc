<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('roles')
            ->add('gender', ChoiceType::class,[
                'choices' => [
                    'Male' => 'm',
                    'Female' => 'f',
                ]
            ])
            ->add('firstname')
            ->add('lastname')
            ->add('nickname')
            ->add('city')
            ->add('country')
            ->add('payment')
            ->add('email')
            ->add('password', PasswordType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

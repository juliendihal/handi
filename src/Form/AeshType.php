<?php

namespace App\Form;

use App\Entity\Interet;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AeshType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('name')
            ->add('firstname')
            ->add('sport', EntityType::class , [
                'class' => Interet::class ,
                'choice_label' =>'sport',
                'mapped'=> false
            ])
            ->add('hobbie', EntityType::class , [
                'class' => Interet::class ,
                'choice_label' =>'hobbie',
                'mapped'=> false
            ])
            ->add('ville', EntityType::class , [
                'class' => Interet::class ,
                'choice_label' =>'ville',
                'mapped'=> false
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

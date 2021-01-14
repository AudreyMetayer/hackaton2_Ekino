<?php

namespace App\Form;

use App\Entity\Salon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'Entrez un nom'
                ]
            ])
            ->add('picture', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Ajoutez une photo'
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Salon::class,
        ]);
    }
}

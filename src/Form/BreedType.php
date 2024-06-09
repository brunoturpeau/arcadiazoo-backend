<?php

namespace App\Form;

use App\Entity\Breed;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BreedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('detail', TextareaType::class,[
                'label' => 'Description',
                'attr' => ['class' => 'editor'],
                'data' => ' ',
            ])
            ->add('name', TextType::class,[
                'label' => 'Nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Breed::class,
        ]);
    }
}

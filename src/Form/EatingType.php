<?php

namespace App\Form;

use App\Entity\Eating;
use App\Entity\Food;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EatingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('feeding')
            ->add('quantity')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('food', EntityType::class, [
                'class' => Food::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eating::class,
        ]);
    }
}

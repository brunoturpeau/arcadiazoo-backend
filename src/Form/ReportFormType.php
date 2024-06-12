<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Report;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class,[
                'label' => false,
                'widget' => 'single_text',
                'input'  => 'datetime_immutable'
            ])
            ->add('detail', TextareaType::class,[
                'label' => "Rapport",
                'attr' => ['class' => 'editor'],
                'data' => ' ',
            ])
            ->add('suggest', TextareaType::class, [
                'label' => 'Repas suggéré',
                'attr' => ['class' => 'editor2'],
                'data' => ' ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Report::class,
        ]);
    }
}

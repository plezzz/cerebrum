<?php

namespace App\Form;

use App\Entity\Patient\Therapy;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TherapyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('drug', TextareaType::class, [
                'label' => 'Терапия',
            ])
            ->add('amount', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Количесвто'],
            ])
            ->add('unit', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Мерна единица'],
            ])
            ->add('morning', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Сутрин'],
            ])
            ->add('lunch', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Обед'],
            ])
            ->add('evening', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Вечер'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Therapy::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Patient\Family;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FamilyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maritalStatus', ChoiceType::class, [
                'label' => 'Семеен статус',
                'choices' => [
                    'Не е посочено' => 'Не е посочено',
                    'Неженен/Неомъжена' => 'Неженен/Неомъжена',
                    'Женен/Омъжена' => 'Женен/Омъжена',
                    'Разведен/Разведена' => 'Разведен/Разведена',
                    'Вдовец/Вдовица' => 'Вдовец/Вдовица',
                ],
            ])
            ->add('haveKids', CheckboxType::class, [
                'label' => 'Има ли деца',
                'data' => false
            ])
            ->add('amountOfBoys', NumberType::class, [
                'label' => 'Колко от тях са момчета',
                'empty_data' => '0',
                'data' => '0',
                'row_attr' => [
                    'class' => 'd-none'
                ]
            ])
            ->add('amountOfGirls', NumberType::class, [
                'label' => 'Колко са момичета',
                'empty_data' => '0',
                'data' => '0',
                'row_attr' => [
                    'class' => 'd-none'
                ]

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Family::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Patient\Details;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientDetailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Sex', ChoiceType::class, [
                'label' => 'Пол',
                'choices' => [
                    'Мъж' => 'Мъж',
                    'Жена' => 'Жена',
                ],
            ])
            ->add('weight', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Тегло'],
            ])
            ->add('height', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Височина'],
            ])
            ->add('hairColor', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Цвят на косата'],
            ])
            ->add('eyeColor', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Цвят на очите'],
            ])
            ->add('maritalStatus', ChoiceType::class, [
                'label' => 'Семеен статус',
                'choices' => [
                    'Неженен/Неомъжена' => 'Неженен/Неомъжена',
                    'Женен/Омъжена' => 'Женен/Омъжена',
                    'Разведен/Разведена' => 'Разведен/Разведена',
                    'Вдовец/Вдовица' => 'Вдовец/Вдовица',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Details::class,
        ]);
    }
}

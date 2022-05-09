<?php

namespace App\Form;

use App\Entity\Patient\Details;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientDetailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sex', ChoiceType::class, [
                'label' => 'Биологичен пол',
                'choices' => [
                    'Не е посочено' => 'Не е посочено',
                    'Мъж' => 'Мъж',
                    'Жена' => 'Жена',
                ],
            ])
            ->add('gender', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['placeholder' => 'Психичен пол'],
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
            ->add('externalSigns', TextareaType::class, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Външни белези'],
            ])
            ->add('bloodType', ChoiceType::class, [
                'label' => 'Кръвна група',
                'required' => false,
                'choices' => [
                    'Не е известно' => 'Не е известно',
                    'AB+' => 'AB+',
                    'AB-' => 'AB-',
                    'A+' => 'A+',
                    'A-' => 'A-',
                    'B+' => 'B+',
                    'B-' => 'B-',
                    '0+' => '0+',
                    '0-' => '0-',
                ],
            ])
            ->add('maritalStatus', ChoiceType::class, [
                'label' => 'Семеен статус',
                'choices' => [
                    'Не е посочено' => 'Не е посочено',
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

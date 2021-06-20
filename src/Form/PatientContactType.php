<?php

namespace App\Form;

use App\Entity\Patient\Contacts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Име'],
            ])
            ->add('lastName', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Фамилия'],
            ])
            ->add('mobilePhone', TelType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Мобилен телефон'],
            ])
            ->add('address', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Местоживеене'],
            ])
            ->add('typeOfContact', ChoiceType::class, [
                'label' => 'Семеен статус:',
                'choices' => [
                    'Роднина' => 'Роднина',
                    'Лекар' => 'Лекар',
                    'Приятел' => 'Приятел'
                ],
            ])
            ->add('isActive', CheckboxType::class, [
                'label' => 'Използвам ли е контакта?',
                'attr' => ['checked' => true]
            ])
            ->add('isDefaultContact', CheckboxType::class, [
                'label' => 'Направи, този контакт по подразбиране?',
                'attr' => ['checked' => false]
            ])
            ->add('note', TextareaType::class, [
                'label' => 'Допълнителна информация',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contacts::class,
        ]);
    }
}

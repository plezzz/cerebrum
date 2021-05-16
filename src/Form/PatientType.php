<?php

namespace App\Form;

use App\Entity\Patient\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Име'],
            ])
            ->add('middleName', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Презиме'],
            ])
            ->add('lastName', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Фамилия'],
            ])
            ->add('EGN', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'ЕГН'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class
        ]);
    }
}

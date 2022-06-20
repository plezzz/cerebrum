<?php

namespace App\Form;

use App\Entity\Patient\Allergy;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AllergyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('allergy', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Алергия'],
            ])
            ->add('symptoms', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Симптоми'],
            ])
            ->add('medication', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Лекарство'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Allergy::class,
        ]);
    }
}

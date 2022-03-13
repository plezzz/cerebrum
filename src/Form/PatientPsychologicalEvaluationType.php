<?php

namespace App\Form;

use App\Entity\Patient\PsychologicalEvaluation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientPsychologicalEvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('familyHistory', TextareaType::class, [
                'label' => 'Лична история',
            ])
            ->add('personalHistory', TextareaType::class, [
                'label' => 'Семейна история',
            ])
            ->add('psychologicalProfile', TextareaType::class, [
                'label' => 'Психологичен профил',
            ])
            ->add('therapeuticPlan', TextareaType::class, [
                'label' => 'Терапевтичен план',
            ])
            ->add('note', TextareaType::class, [
                'label' => 'Допълнителна информация',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PsychologicalEvaluation::class,
        ]);
    }
}

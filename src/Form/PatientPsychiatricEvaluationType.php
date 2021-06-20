<?php

namespace App\Form;

use App\Entity\Patient\PsychiatricEvaluation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientPsychiatricEvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('diagnostic', TextareaType::class, [
                'label' => 'Диагноза',
                'required' => false,
            ])
            ->add('MKB', TextareaType::class, [
                'label' => 'МКБ',
                'required' => false,
            ])
            ->add('medicalHistory', TextareaType::class, [
                'label' => 'Анамнеза',
                'required' => false,
            ])
            ->add('concomitantDiseases', TextareaType::class, [
                'label' => 'Съпътстващи заболявания',
                'required' => false,
            ])
            ->add('psychiatricEvaluation', TextareaType::class, [
                'label' => 'Психиатрична оценка',
                'required' => false,
            ])
            ->add('observationPeriodFrom', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'dd-MM-yyyy',
            ])
            ->add('observationPeriodTo', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'dd-MM-yyyy',
            ])
            ->add('expertOpinion', TextareaType::class, [
                'label' => 'Експертно мнение',
                'required' => false,
            ])
            ->add('note', TextareaType::class, [
                'label' => 'Друго',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PsychiatricEvaluation::class,
        ]);
    }
}

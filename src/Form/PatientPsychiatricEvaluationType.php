<?php

namespace App\Form;

use App\Entity\Patient\PsychiatricEvaluation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientPsychiatricEvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('anamnesisWastaken', TextareaType::class, [
                'label' => 'Анамнезата е снета по данни на:',
            ])
            ->add('pastIllnesses', TextareaType::class, [
                'label' => 'Минали заболявания:',
            ])
            ->add('accompanyingDiseases', TextareaType::class, [
                'label' => 'Придружаващи заболявания:',
            ])
            ->add('familyHistory', TextareaType::class, [
                'label' => 'Фамилна анамнеза:',
            ])
            ->add('premorbidDevelopment', TextareaType::class, [
                'label' => 'Преморбидно развитие:',
            ])
            ->add('earlyDevelopment', TextareaType::class, [
                'label' => 'Ранно развитие:',
            ])
            ->add('pregnancy', TextareaType::class, [
                'label' => 'Бременност',
            ])
            ->add('birth', TextareaType::class, [
                'label' => 'Раждане:',
            ])
            ->add('neonatalPeriod', TextareaType::class, [
                'label' => 'Неонатален период:',
            ])
            ->add('nutrition', TextareaType::class, [
                'label' => 'Хранене: кърмене ',
            ])
            ->add('motorDevelopment', TextareaType::class, [
                'label' => 'Двигателно развитие',
            ])
            ->add('speechDevelopmentAndCommunication', TextareaType::class, [
                'label' => 'Развитие на речта и комуникация:',
            ])
            ->add('selfService', TextareaType::class, [
                'label' => 'Самообслужване: хранене- ; обличане- ; ТРФ- ',
            ])
            ->add('socialization', TextareaType::class, [
                'label' => 'Социализация:',
            ])
            ->add('behavior', TextareaType::class, [
                'label' => 'Игри, интереси, поведение:',
            ])
            ->add('family', TextareaType::class, [
                'label' => 'Семейство:',
            ])
            ->add('styleOfAttachment', TextareaType::class, [
                'label' => 'Стил на привързване:',
            ])
            ->add('youth', TextareaType::class, [
                'label' => 'Юношество:',
            ])
            ->add('adultAge', TextareaType::class, [
                'label' => 'Зряла възраст:',
            ])
            ->add('medicalHistory', TextareaType::class, [
                'label' => 'История на заболяването:',
            ])
            ->add('hospitalization', TextareaType::class, [
                'label' => 'Хоспитализации:',
            ])
            ->add('lastHospitalization', TextareaType::class, [
                'label' => 'Последна хоспитализация:',
            ])
            ->add('manifestationsOfAutoaggressionOrAggression', TextareaType::class, [
                'label' => 'Прояви на автоагресия или агресия:',
            ])
            ->add('allergies', TextareaType::class, [
                'label' => 'Алергии:',
            ])
            ->add('lifeStyle', TextareaType::class, [
                'label' => 'Стил на живот:',
            ])
            ->add('surfactantAbuse', TextareaType::class, [
                'label' => 'Злоупотреба с ПАВ:',
            ])
            ->add('problemsWithTheLaw', TextareaType::class, [
                'label' => 'Проблеми със закона:',
            ])
            ->add('somaticStatus', TextareaType::class, [
                'label' => 'Соматичен статус:',
            ])
            ->add('neurologicalStatus', TextareaType::class, [
                'label' => 'Неврологичен статус:',
            ])
            ->add('mentalStatus', TextareaType::class, [
                'label' => 'Психичен статус:',
            ])
            ->add('syndrome', TextareaType::class, [
                'label' => 'Синдром:',
            ])
            ->add('differentialDiagnosis', TextareaType::class, [
                'label' => 'Диференциална диагноза:',
            ])
            ->add('therapeuticPlan', TextareaType::class, [
                'label' => 'Терапевтичен план:',
            ])
            ->add('therapy', TextareaType::class, [
                'label' => 'Терапия:',
            ])
            ->add('note', TextareaType::class, [
                'label' => 'Допълнителна информация',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PsychiatricEvaluation::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Patient\PsychiatricEvaluation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientPsychiatricEvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note')
            ->add('anamnesisWastaken')
            ->add('pastIllnesses')
            ->add('accompanyingDiseases')
            ->add('familyHistory')
            ->add('premorbidDevelopment')
            ->add('earlyDevelopment')
            ->add('pregnancy')
            ->add('birth')
            ->add('neonatalPeriod')
            ->add('nutrition')
            ->add('motorDevelopment')
            ->add('speechDevelopmentAndCommunication')
            ->add('selfService')
            ->add('socialization')
            ->add('behavior')
            ->add('family')
            ->add('styleOfAttachment')
            ->add('medicalHistory')
            ->add('hospitalization')
            ->add('lastHospitalization')
            ->add('manifestationsOfAutoaggressionOrAggression')
            ->add('allergies')
            ->add('lifeStyle')
            ->add('surfactantAbuse')
            ->add('problemsWithTheLaw')
            ->add('somaticStatus')
            ->add('neurologicalStatus')
            ->add('mentalStatus')
            ->add('syndrome')
            ->add('differentialDiagnosis')
            ->add('therapeuticPlan')
            ->add('therapy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PsychiatricEvaluation::class,
        ]);
    }
}

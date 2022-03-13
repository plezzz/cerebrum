<?php

namespace App\Form;

use App\Entity\Patient\SocialEvaluation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientSocialEvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('socialStatus', TextareaType::class, [
                'label' => 'Социален статус',
            ])
            ->add('socialNeeds', TextareaType::class, [
                'label' => 'Социални потребности',
            ])
            ->add('socialAssessment', TextareaType::class, [
                'label' => 'Социална оценка',
            ])
            ->add('socialIntegration', TextareaType::class, [
                'label' => 'Препоръка за социална интеграция',
            ])
            ->add('note', TextareaType::class, [
                'label' => 'Допълнителна бележка',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SocialEvaluation::class,
        ]);
    }
}

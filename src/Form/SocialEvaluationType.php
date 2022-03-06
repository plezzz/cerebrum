<?php

namespace App\Form;

use App\Entity\Patient\SocialEvaluation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocialEvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('socialStatus', TextType::class, [
                'label' => 'Социален статус',
                'required' => false,
            ])
            ->add('needs', TextType::class, [
                'label' => 'Социални потребности',
                'required' => false,
            ])
            ->add('assessment', TextType::class, [
                'label' => 'Социална оценка',
                'required' => false,
            ])
            ->add('recommendation', TextType::class, [
                'label' => 'Препоръка за социална интеграция',
                'required' => false,
            ])
            ->add('note', TextType::class, [
                'label' => 'Допълнителни бележки',
                'required' => false,
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

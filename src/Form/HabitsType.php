<?php

namespace App\Form;

use App\Entity\Patient\Habits;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function PHPUnit\Framework\isNull;

class HabitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('smoking', CheckboxType::class, [
                'label' => 'Пушач ли е',
                'data' => false
            ])
            ->add('amountOfCigarettesPerDay', NumberType::class, [
               'label'=> 'Колко цигари на ден употребява'
            ])
            ->add('alcohol', CheckboxType::class, [
                'label' => 'Употребява ли алкохол',
                'data' => false
            ])
            ->add('amountOfAlcoholPerDay', NumberType::class, [
                'label'=> 'Какво количесто изпива средно в мл.'
            ])
            ->add('howOftenHeConsumesAlcohol', ChoiceType::class, [
                'label'=> 'Колко често употрвбява алкохол',
                'choices'  => [
                    'Всеки ден' => 'Всеки ден',
                    'Няколко пъти седмично' => 'Няколко пъти седмично',
                    'Веднъж седмично' => 'Веднъж седмично',
                ],
                ])
            ->add('narcotics', CheckboxType::class, [
                'label' => 'Употребява ли наркотици',
                'data' => false
            ])
            ->add('howOftenHeUsesDrugs', ChoiceType::class, [
                'label'=> 'Колко често употрвбява наркотици',
                'choices'  => [
                    'Всеки ден' => 'Всеки ден',
                    'Няколко пъти седмично' => 'Няколко пъти седмично',
                    'Веднъж седмично' => 'Веднъж седмично',
                ],
            ])
            ->add('whatTypeOfDrugUses', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Какъв тип наркотици употребява'],
            ])
            ->add('useInTheMomentNarcotics', CheckboxType::class, [
                'label' => 'Употребява ли наркотици в момента',
                'data' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Habits::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Patient\Workplace;
use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkplaceType extends AbstractType
{
    private CountryRepository $countryRepository;
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('position', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Заемана длъжност или позиция'],
                'required' => false
            ])
            ->add('employer', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Работодател'],
                'required' => false
            ])
            ->add('city', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Град'],
                'required' => false
            ])
            ->add('country', EntityType::class, [
                'label' => 'Държава',
                'class' => Country::class,
                'choice_label' => 'name',
                'required' => false,
                'data' => $this->countryRepository->find(33)
            ])
            ->add('workFrom', DateTimeType::class, [
                'label' => 'Дата на започване',
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker','autocomplete' => 'disabled'],
                'format' => 'dd-MM-yyyy',
                'empty_data' => '01-01-1900',
                'required' => false
            ])
            ->add('workTo', DateTimeType::class, [
                'label' => 'Дата на приключване',
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker','autocomplete' => 'disabled'],
                'format' => 'dd-MM-yyyy',
                'empty_data' => '01-01-1900',
                'required' => false
            ])
            ->add('isWorkHere', CheckboxType::class, [
                'label' => 'В ход',
                'data' => false,
                'required' => false
            ])
            ->add('moreInformation', CheckboxType::class, [
                'label' => 'Допълнителна информация',
                'attr' => ['class' => 'moreInformationButton'],
                'data' => false,
                'required' => false
            ])
            ->add('responsibilities', TextareaType::class, [
                'label' => false,
                'attr' => ['Placeholder'=>'Основни дейности и отговорности','class' => 'd-none moreInformation'],
                'required' => false
            ])
            ->add('sector', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Сектор','class' => 'd-none moreInformation'],
                 'required' => false
            ])
            ->add('department', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Отдел','class' => 'd-none moreInformation'],
                 'required' => false
            ])
            ->add('address', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Адрес','class' => 'd-none moreInformation'],
                 'required' => false
            ])
            ->add('postcode', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Пощенски код','class' => 'd-none moreInformation'],
                 'required' => false
            ])
            ->add('phone', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Телефон','class' => 'd-none moreInformation'],
                 'required' => false
            ])
            ->add('email', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Имейл','class' => 'd-none moreInformation'],
                'required' => false
            ])
            ->add('website', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Уеб сайт','class' => 'd-none moreInformation'],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Workplace::class,
        ]);
    }
}

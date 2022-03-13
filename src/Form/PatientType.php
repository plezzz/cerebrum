<?php

namespace App\Form;

use App\Entity\Patient\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
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
            ])
//            ->add('dateOfBirth', DateType::class, [
//                'data_class' => null,
//                'widget' => 'single_text',
//                //'format' => 'dd/mm/yyyy', // Note here, it will change to default {{ year }}{{ month }}{{ day }} but dd/MM/yyyy will work
//                'input' => 'datetime',
//                'invalid_message' => 's',
//                'required' => true,
//                'model_timezone' => 'Europe/Sofia',
//                'view_timezone' => 'Europe/Sofia',
//                'attr' => [
//                    'data-date-format' => "DД MMMM YYYY"
//                ]
////                'widget' => 'single_text',
//////                'format' => 'yyyy-MM-dd',
////                'input_format' => 'y-d-m',
//            ])
            ->add('dateOfBirth', DateType::class, [
                'label' => 'Дата на раждане',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'dd-MM-yyyy',
            ])
            ->add('mobilePhone', TelType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Мобилен телефон'],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Имейл'],
                'required' => false
//                'help' => 'The ZIP/Postal code for your credit card\'s billing address.'
            ])
//            ->add('isInHospital', CheckboxType::class, [
//                'label' => 'Пациента в болница ли е?',
//                'value' => false,
//                'required' => false
//            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class
        ]);
    }
}

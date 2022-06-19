<?php

namespace App\Form;

use App\Entity\Patient\IDCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IDCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('IDNumber', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Лична карта номер'],
            ])
            ->add('validity', DateType::class, [
                'label' => 'Дата на раждане',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker','autocomplete' => 'disabled'],
                'format' => 'dd-MM-yyyy',
                'empty_data' => '0000-00-00'

            ])
            ->add('placeOfResidenceByID', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Местоживеене по лична карта'],
            ])
            ->add('placeOfResidenceByCurrentLocation', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Местоживеене'],
            ])
            ->add('publishedBy', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Издадена от'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IDCard::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Patient\IDCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IDCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('IDNumber')
            ->add('validity')
            ->add('placeOfResidenceByID')
            ->add('placeOfResidenceByCurrentLocation')
            ->add('publishedBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IDCard::class,
        ]);
    }
}

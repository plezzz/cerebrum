<?php

namespace App\Form;

use App\Entity\Patient\Details;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientDetailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Sex')
            ->add('weight')
            ->add('height')
            ->add('hairColor')
            ->add('eyeColor')
            ->add('maritalStatus')
            ->add('patient')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Details::class,
        ]);
    }
}

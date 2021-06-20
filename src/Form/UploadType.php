<?php

namespace App\Form;

use App\Entity\FileUpload;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextareaType::class, [
                'label' => 'Описание',
                'required' => false,
            ])
            ->add('upload_file', FileType::class, [
                'label' => false,
                'mapped' => false, // Tell that there is no Entity to link
                'required' => true,
                'constraints' => [
                    new File()
                ],
            ])
            ->add('send', SubmitType::class); // We could have added it in the view, as stated in the framework recommendations

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FileUpload::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\User;
use App\Service\Role\RoleServiceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    private RoleServiceInterface $roles;

    public function __construct(RoleServiceInterface $roles)
    {
        $this->roles = $roles;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        //$roles1 = ['Потребител'=>'ROLE_USER', 'Администратор'=>'ROLE_ADMIN', 'Супер Администратор'=>'ROLE_SUPER_ADMIN'];
        //print_r($this->roles->findAllArray());
        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Имейл'],
//                'help' => 'The ZIP/Postal code for your credit card\'s billing address.'
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Изберете роли на потребителя?',
                'choices' => $this->roles->findAllArray(),
                'multiple' => true,
                'expanded' => true
            ])
            ->add('password', RepeatedType::class, [
                "type" => PasswordType::class,
                'invalid_message' => 'Паролата не съвпада.',
                "first_options" => ['label' => false, 'attr' => ['placeholder' => 'Парола'], 'help' => 'Паролата трябва да бъде минимум 10 символа на латиница, да съдържа поне една голяма и малка буква, число и специален знак.'],
                'second_options' => ['label' => false, 'attr' => ['placeholder' => 'Повторение на паролата']]
            ])
            ->add('mobilePhone', TelType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Мобилен телефон'],
            ])
            ->add('firstName', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Име'],
            ])
            ->add('lastName', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Фамилия'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

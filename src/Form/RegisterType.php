<?php

namespace App\Form;

use App\Entity\User;
use App\Service\Role\RoleServiceInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
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
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'label' => 'Изберете роли на потребителя?',
                'choices' => $this->roles->findAllArray(),
                'multiple' => true,
                'expanded' => true
            ])
            ->add('password')
            ->add('mobilePhone')
            ->add('firstName')
            ->add('lastName')
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

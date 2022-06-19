<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Service\Common\DateTimeServiceInterface;
use App\Service\Role\RoleServiceInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;
    private DateTimeServiceInterface $dateTimeService;
    private RoleServiceInterface $roleService;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, DateTimeServiceInterface $dateTimeService, RoleServiceInterface $roleService)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->dateTimeService = $dateTimeService;
        $this->roleService = $roleService;

    }

    public function load(ObjectManager $manager): void
    {
        $roles = ['Потребител' => 'ROLE_USER','Персонал' => 'ROLE_PERSONAL','Лекар' => 'ROLE_DOCTOR', 'Администратор' => 'ROLE_ADMIN', 'Супер Администратор' => 'ROLE_SUPER_ADMIN'];
        foreach ($roles as $key => $value) {
            $role = new Role();
            $role->setName($value);
            $role->setTitle($key);
            $manager->persist($role);
        }
        $manager->flush();


        $user = new User();
        $user->setEmail('nikid12e@gmail.com');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                '1234'
            )
        );
//        var_dump('dd');
//        print_r($this->roleService->findAll());
        //$user->setRoles($this->roleService->findAll());
//        $user->addRole($this->roleService->findOneByName('ROLE_USER'));
//        $user->addRole($this->roleService->findOneByName('ROLE_ADMIN'));
        $user->addRole($this->roleService->findOneByName('ROLE_SUPER_ADMIN'));
        $user->setMobilePhone('886346234');
        $user->setCreatedAt($this->dateTimeService->setDateTimeNow());
        $user->setEditedAt($this->dateTimeService->setDateTimeNow());
        $user->setFirstName('Nikolay');
        $user->setLastName('Kovachev');
        $user->setIsActive(true);
        $user->setIsDeleted(false);
        $user->setIsVerified(true);
        $manager->persist($user);
        $manager->flush();
    }
}

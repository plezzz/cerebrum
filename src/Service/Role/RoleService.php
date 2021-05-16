<?php


namespace App\Service\Role;

use App\Entity\Role;
use App\Repository\RoleRepository;

class RoleService implements RoleServiceInterface
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param string $criteria
     * @return Role|null
     */
    public function findOneByName(string $criteria): ?Role
    {
        return $this->roleRepository->findOneBy(
            ['name' => $criteria]
        );
    }

    /**
     * @return Role[]
     */
    public function findAll(): array
    {
        return $this->roleRepository->findAll();
    }


    public function save(Role $role): bool
    {
        return $this->roleRepository->insert($role);
    }


    public function findAllArray(): array
    {
        $roleStylize = [];
        $roles = $this->roleRepository->findAll();
        foreach ($roles as $role) {
            $roleStylize[$role->getTitle()] = $role->getName();
        }
        return $roleStylize;

    }
}

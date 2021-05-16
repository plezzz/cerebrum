<?php


namespace App\Service\Role;


use App\Entity\Role;

interface RoleServiceInterface
{
    public function findOneByName(string $criteria);

    public function findAll(): array;

    public function findAllArray(): array;

    public function save(Role $role): bool;
}

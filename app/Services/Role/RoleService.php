<?php

namespace App\Services\Role;

use App\Repositories\Role\IRoleRepository;

class RoleService implements IRoleService
{
    public function __construct(private IRoleRepository $roleRepository) {}

    public function all(array $columns = ['*'])
    {
        return $this->roleRepository->all($columns);
    }

    public function getByName(string $name, array $columns = ['*'])
    {
        return $this->roleRepository->getByName($name, $columns);
    }

    public function create(array $data)
    {
        return $this->roleRepository->create($data);
    }

    public function update(array $data, string $name)
    {
        return $this->roleRepository->update($data, $name);
    }

    public function delete(string $name)
    {
        return $this->roleRepository->delete($name);
    }
}

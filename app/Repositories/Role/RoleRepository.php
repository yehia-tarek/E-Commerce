<?php

namespace App\Repositories\Role;

use Exception;
use Spatie\Permission\Models\Role;
use App\Repositories\Role\IRoleRepository;

class RoleRepository implements IRoleRepository
{
    public function __construct(private Role $model) {}

    public function all(array $columns = ['*'])
    {
        return $this->model->paginate(10, $columns);
    }

    public function create(array $data)
    {
        $role = $this->model->create([
            'name' => $data['name'],
            'guard_name' => 'admin',
        ]);

        $role->syncPermissions($data['permissions']);

        return $role;
    }

    public function update(array $data, string $name)
    {
        $role = $this->model->where('name', $name)->first();

        $role->update([
            'name' => $data['name'],
            'guard_name' => 'admin',
        ]);

        $role->syncPermissions($data['permissions']);

        return $role;
    }

    public function delete(string $name)
    {
        $role = $this->model->where('name', $name)->first();

        if (!$role) {
            throw new Exception('Role not found');
        }

        if ($role->name === 'Super Admin') {
            throw new Exception('Super Admin role cannot be deleted');
        }

        $role->delete();

        return $role;
    }

    public function getByName(string $name, array $columns = ['*'])
    {
        return $this->model->where('name', $name)->first($columns);
    }
}

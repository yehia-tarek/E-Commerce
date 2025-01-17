<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Repositories\Admin\IAdminRepository;

class AdminRepository implements IAdminRepository
{
    public function all(array $columns = ['*'], array $relations = [])
    {
        return Admin::with($relations)->paginate(10, $columns);
    }

    public function getById(int $id, array $columns = ['*'], array $relations = [])
    {
        return Admin::with($relations)->find($id, $columns);
    }

    public function create(array $data)
    {
        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if (isset($data['role'])) {
            $admin->syncRoles($data['role']);
        }

        return $admin;
    }

    public function update(int $id, array $data)
    {
        $admin = $this->getById($id);

        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $admin->update($data);

        if (isset($data['role'])) {
            $admin->syncRoles($data['role']);
        }

        return $admin;
    }

    public function delete(int $id)
    {
        return Admin::where('id', $id)->delete();
    }
}

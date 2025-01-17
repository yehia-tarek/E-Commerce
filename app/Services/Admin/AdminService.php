<?php

namespace App\Services\Admin;

use App\Services\Admin\IAdminService;
use App\Repositories\Admin\IAdminRepository;

class AdminService implements IAdminService
{
    public function __construct(private IAdminRepository $adminRepository)
    {
    }

    public function all(array $columns = ['*'], array $relations = [])
    {
        return $this->adminRepository->all($columns, $relations);
    }

    public function getById(int $id, array $columns = ['*'], array $relations = [])
    {
        return $this->adminRepository->getById($id, $columns, $relations);
    }

    public function create(array $data)
    {
        return $this->adminRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->adminRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->adminRepository->delete($id);
    }
}

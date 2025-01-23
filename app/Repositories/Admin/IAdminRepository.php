<?php

namespace App\Repositories\Admin;


interface IAdminRepository
{
    public function all(array $columns = ['*'], array $relations = []);
    public function getById(int $id, array $columns = ['*'], array $relations = []);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function updatePassword(int $id, array $data);
}

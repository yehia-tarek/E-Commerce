<?php

namespace App\Services\Category;

interface ICategoryService
{
    public function all();
    public function tree();
    public function getById($id);
    public function store($data);
    public function update($id, $data);
    public function delete($id);
}

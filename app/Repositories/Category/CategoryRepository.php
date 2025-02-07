<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\ICategoryRepository;

class CategoryRepository implements ICategoryRepository
{
    public function __construct(
        private Category $model
    ){}

    public function all()
    {
        return $this->model->all();
    }

    public function tree()
    {
        return $this->model->get(['id', 'name', 'parent_id', '_lft', '_rgt'])->toTree()->toArray();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}

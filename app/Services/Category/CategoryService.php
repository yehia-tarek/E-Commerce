<?php

namespace App\Services\Category;

use App\Repositories\Category\ICategoryRepository;
use App\Services\Category\ICategoryService;

class CategoryService implements ICategoryService
{
    public function __construct(
        private ICategoryRepository $categoryRepository
    ) {}

    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function tree()
    {
        return $this->categoryRepository->tree();
    }

    public function getById($id)
    {
        return $this->categoryRepository->getById($id);
    }

    public function store($data)
    {
        return $this->categoryRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}

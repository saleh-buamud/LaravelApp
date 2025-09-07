<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Get all categories
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Get category by ID
     */
    public function findById(int $id): ?Category
    {
        return $this->model->find($id);
    }

    /**
     * Create a new category
     */
    public function create(array $data): Category
    {
        return $this->model->create($data);
    }

    /**
     * Update a category
     */
    public function update(int $id, array $data): bool
    {
        $category = $this->findById($id);
        
        if (!$category) {
            return false;
        }

        return $category->update($data);
    }

    /**
     * Delete a category
     */
    public function delete(int $id): bool
    {
        $category = $this->findById($id);
        
        if (!$category) {
            return false;
        }

        return $category->delete();
    }

    /**
     * Get categories with subcategories
     */
    public function getWithSubCategories(): Collection
    {
        return $this->model->with('subCategories')->get();
    }
}

<?php

namespace App\Repositories;

use App\Models\SubCategory;
use App\Repositories\Contracts\SubCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    protected SubCategory $model;

    public function __construct(SubCategory $model)
    {
        $this->model = $model;
    }

    /**
     * Get all subcategories
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Get subcategory by ID
     */
    public function findById(int $id): ?SubCategory
    {
        return $this->model->find($id);
    }

    /**
     * Get subcategories by category ID
     */
    public function getByCategoryId(int $categoryId): Collection
    {
        return $this->model->where('category_id', $categoryId)->get();
    }

    /**
     * Create a new subcategory
     */
    public function create(array $data): SubCategory
    {
        return $this->model->create($data);
    }

    /**
     * Update a subcategory
     */
    public function update(int $id, array $data): bool
    {
        $subCategory = $this->findById($id);
        
        if (!$subCategory) {
            return false;
        }

        return $subCategory->update($data);
    }

    /**
     * Delete a subcategory
     */
    public function delete(int $id): bool
    {
        $subCategory = $this->findById($id);
        
        if (!$subCategory) {
            return false;
        }

        return $subCategory->delete();
    }

    /**
     * Get subcategories with category
     */
    public function getWithCategory(): Collection
    {
        return $this->model->with('category')->get();
    }
}

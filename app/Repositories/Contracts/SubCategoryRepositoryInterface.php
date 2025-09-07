<?php

namespace App\Repositories\Contracts;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Collection;

interface SubCategoryRepositoryInterface
{
    /**
     * Get all subcategories
     */
    public function getAll(): Collection;

    /**
     * Get subcategory by ID
     */
    public function findById(int $id): ?SubCategory;

    /**
     * Get subcategories by category ID
     */
    public function getByCategoryId(int $categoryId): Collection;

    /**
     * Create a new subcategory
     */
    public function create(array $data): SubCategory;

    /**
     * Update a subcategory
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a subcategory
     */
    public function delete(int $id): bool;

    /**
     * Get subcategories with category
     */
    public function getWithCategory(): Collection;
}

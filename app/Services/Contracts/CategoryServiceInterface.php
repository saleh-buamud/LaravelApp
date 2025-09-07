<?php

namespace App\Services\Contracts;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceInterface
{
    /**
     * Get all categories
     */
    public function getAllCategories(): Collection;

    /**
     * Get category by ID
     */
    public function getCategoryById(int $id): ?Category;

    /**
     * Get categories with subcategories
     */
    public function getCategoriesWithSubCategories(): Collection;

    /**
     * Create a new category
     */
    public function createCategory(array $data): Category;

    /**
     * Update a category
     */
    public function updateCategory(int $id, array $data): bool;

    /**
     * Delete a category
     */
    public function deleteCategory(int $id): bool;
}

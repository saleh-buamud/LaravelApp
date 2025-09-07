<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    /**
     * Get all categories
     */
    public function getAll(): Collection;

    /**
     * Get category by ID
     */
    public function findById(int $id): ?Category;

    /**
     * Create a new category
     */
    public function create(array $data): Category;

    /**
     * Update a category
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a category
     */
    public function delete(int $id): bool;

    /**
     * Get categories with subcategories
     */
    public function getWithSubCategories(): Collection;
}

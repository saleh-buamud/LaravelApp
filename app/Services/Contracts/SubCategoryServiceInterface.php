<?php

namespace App\Services\Contracts;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Collection;

interface SubCategoryServiceInterface
{
    /**
     * Get all subcategories
     */
    public function getAllSubCategories(): Collection;

    /**
     * Get subcategory by ID
     */
    public function getSubCategoryById(int $id): ?SubCategory;

    /**
     * Get subcategories by category ID
     */
    public function getSubCategoriesByCategoryId(int $categoryId): Collection;
}

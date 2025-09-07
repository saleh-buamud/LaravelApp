<?php

namespace App\Services;

use App\Models\SubCategory;
use App\Repositories\Contracts\SubCategoryRepositoryInterface;
use App\Services\Contracts\SubCategoryServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class SubCategoryService implements SubCategoryServiceInterface
{
    protected SubCategoryRepositoryInterface $subCategoryRepository;

    public function __construct(SubCategoryRepositoryInterface $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    /**
     * Get all subcategories
     */
    public function getAllSubCategories(): Collection
    {
        return $this->subCategoryRepository->getWithCategory();
    }

    /**
     * Get subcategory by ID
     */
    public function getSubCategoryById(int $id): ?SubCategory
    {
        return $this->subCategoryRepository->findById($id);
    }

    /**
     * Get subcategories by category ID
     */
    public function getSubCategoriesByCategoryId(int $categoryId): Collection
    {
        return $this->subCategoryRepository->getByCategoryId($categoryId);
    }
}

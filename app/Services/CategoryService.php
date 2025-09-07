<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CategoryService implements CategoryServiceInterface
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get all categories
     */
    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Get category by ID
     */
    public function getCategoryById(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    /**
     * Get categories with subcategories
     */
    public function getCategoriesWithSubCategories(): Collection
    {
        return $this->categoryRepository->getWithSubCategories();
    }

    /**
     * Create a new category
     */
    public function createCategory(array $data): Category
    {
        // Handle image upload if present
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return $this->categoryRepository->create($data);
    }

    /**
     * Update a category
     */
    public function updateCategory(int $id, array $data): bool
    {
        $category = $this->categoryRepository->findById($id);
        
        if (!$category) {
            return false;
        }

        // Handle image upload if present
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            // Delete old image if exists
            if ($category->image) {
                $this->deleteImage($category->image);
            }
            
            $data['image'] = $this->uploadImage($data['image']);
        }

        return $this->categoryRepository->update($id, $data);
    }

    /**
     * Delete a category
     */
    public function deleteCategory(int $id): bool
    {
        $category = $this->categoryRepository->findById($id);
        
        if ($category && $category->image) {
            $this->deleteImage($category->image);
        }

        return $this->categoryRepository->delete($id);
    }

    /**
     * Upload category image
     */
    protected function uploadImage(UploadedFile $file): string
    {
        return $file->store('categories', 'public');
    }

    /**
     * Delete category image
     */
    protected function deleteImage(string $imagePath): void
    {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}

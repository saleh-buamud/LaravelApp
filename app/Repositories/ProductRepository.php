<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    protected Product $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Get all products with pagination
     */
    public function getAll(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->with(['subCategory.category'])->paginate($perPage);
    }

    /**
     * Get product by ID
     */
    public function findById(int $id): ?Product
    {
        return $this->model->with(['subCategory.category'])->find($id);
    }

    /**
     * Get products by sub category ID
     */
    public function getBySubCategory(int $subCategoryId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->where('sub_category_id', $subCategoryId)
            ->with(['subCategory.category'])
            ->paginate($perPage);
    }

    /**
     * Search products by keyword
     */
    public function search(string $keyword, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->search($keyword)
            ->with(['subCategory.category'])
            ->paginate($perPage);
    }

    /**
     * Get low stock products
     */
    public function getLowStock(int $threshold = 5): Collection
    {
        return $this->model
            ->where('quantity', '<', $threshold)
            ->with(['subCategory.category'])
            ->get();
    }

    /**
     * Create a new product
     */
    public function create(array $data): Product
    {
        return $this->model->create($data);
    }

    /**
     * Update a product
     */
    public function update(int $id, array $data): bool
    {
        $product = $this->findById($id);
        
        if (!$product) {
            return false;
        }

        return $product->update($data);
    }

    /**
     * Delete a product
     */
    public function delete(int $id): bool
    {
        $product = $this->findById($id);
        
        if (!$product) {
            return false;
        }

        return $product->delete();
    }

    /**
     * Update product quantity
     */
    public function updateQuantity(int $id, int $quantity): bool
    {
        $product = $this->findById($id);
        
        if (!$product) {
            return false;
        }

        return $product->update(['quantity' => $quantity]);
    }
}

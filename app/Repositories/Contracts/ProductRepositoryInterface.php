<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    /**
     * Get all products with pagination
     */
    public function getAll(int $perPage = 15): LengthAwarePaginator;

    /**
     * Get product by ID
     */
    public function findById(int $id): ?Product;

    /**
     * Get products by sub category ID
     */
    public function getBySubCategory(int $subCategoryId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Search products by keyword
     */
    public function search(string $keyword, int $perPage = 15): LengthAwarePaginator;

    /**
     * Get low stock products
     */
    public function getLowStock(int $threshold = 5): Collection;

    /**
     * Create a new product
     */
    public function create(array $data): Product;

    /**
     * Update a product
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a product
     */
    public function delete(int $id): bool;

    /**
     * Update product quantity
     */
    public function updateQuantity(int $id, int $quantity): bool;
}

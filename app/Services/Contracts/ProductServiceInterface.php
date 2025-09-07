<?php

namespace App\Services\Contracts;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProductServiceInterface
{
    /**
     * Get all products with pagination
     */
    public function getAllProducts(int $perPage = 15): LengthAwarePaginator;

    /**
     * Get product by ID
     */
    public function getProductById(int $id): ?Product;

    /**
     * Get products by sub category
     */
    public function getProductsBySubCategory(int $subCategoryId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Search products
     */
    public function searchProducts(string $keyword, int $perPage = 15): LengthAwarePaginator;

    /**
     * Get low stock products
     */
    public function getLowStockProducts(int $threshold = 5): Collection;

    /**
     * Create a new product
     */
    public function createProduct(array $data): Product;

    /**
     * Update a product
     */
    public function updateProduct(int $id, array $data): bool;

    /**
     * Delete a product
     */
    public function deleteProduct(int $id): bool;

    /**
     * Update product quantity
     */
    public function updateProductQuantity(int $id, int $quantity): bool;
}

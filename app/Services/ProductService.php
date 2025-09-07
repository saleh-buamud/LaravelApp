<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductService implements ProductServiceInterface
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get all products with pagination
     */
    public function getAllProducts(int $perPage = 15): LengthAwarePaginator
    {
        return $this->productRepository->getAll($perPage);
    }

    /**
     * Get product by ID
     */
    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->findById($id);
    }

    /**
     * Get products by sub category
     */
    public function getProductsBySubCategory(int $subCategoryId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->productRepository->getBySubCategory($subCategoryId, $perPage);
    }

    /**
     * Search products
     */
    public function searchProducts(string $keyword, int $perPage = 15): LengthAwarePaginator
    {
        return $this->productRepository->search($keyword, $perPage);
    }

    /**
     * Get low stock products
     */
    public function getLowStockProducts(int $threshold = 5): Collection
    {
        return $this->productRepository->getLowStock($threshold);
    }

    /**
     * Create a new product
     */
    public function createProduct(array $data): Product
    {
        // Handle image upload if present
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return $this->productRepository->create($data);
    }

    /**
     * Update a product
     */
    public function updateProduct(int $id, array $data): bool
    {
        // Handle image upload if present
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return $this->productRepository->update($id, $data);
    }

    /**
     * Delete a product
     */
    public function deleteProduct(int $id): bool
    {
        $product = $this->productRepository->findById($id);
        
        if ($product && $product->image) {
            $this->deleteImage($product->image);
        }

        return $this->productRepository->delete($id);
    }

    /**
     * Update product quantity
     */
    public function updateProductQuantity(int $id, int $quantity): bool
    {
        return $this->productRepository->updateQuantity($id, $quantity);
    }

    /**
     * Upload product image
     */
    protected function uploadImage(UploadedFile $file): string
    {
        return $file->store('products', 'public');
    }

    /**
     * Delete product image
     */
    protected function deleteImage(string $imagePath): void
    {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}

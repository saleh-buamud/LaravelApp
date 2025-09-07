<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    protected ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Get cart contents
     */
    public function index(): JsonResponse
    {
        $items = Cart::getContent();
        $total = Cart::getTotal();
        $totalQuantity = Cart::getTotalQuantity();

        return response()->json([
            'success' => true,
            'message' => 'Cart retrieved successfully',
            'data' => [
                'items' => $items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'total' => $item->getPriceSum(),
                        'image' => $item->attributes->image ?? null,
                    ];
                }),
                'total' => $total,
                'total_quantity' => $totalQuantity,
                'item_count' => $items->count(),
            ],
        ]);
    }

    /**
     * Add item to cart
     */
    public function add(Request $request, int $productId): JsonResponse
    {
        $request->validate([
            'quantity' => 'sometimes|integer|min:1',
        ]);

        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        if (!$product->isInStock()) {
            return response()->json([
                'success' => false,
                'message' => 'Product is out of stock',
            ], 400);
        }

        $quantity = $request->get('quantity', 1);

        if ($product->quantity < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock. Available: ' . $product->quantity,
            ], 400);
        }

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'attributes' => [
                'image' => $product->image,
            ],
            'associatedModel' => $product,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully',
            'data' => [
                'total_quantity' => Cart::getTotalQuantity(),
                'item_count' => Cart::getContent()->count(),
            ],
        ]);
    }

    /**
     * Update item quantity in cart
     */
    public function update(Request $request, int $productId): JsonResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $item = Cart::get($productId);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart',
            ], 404);
        }

        $quantity = $request->quantity;

        if ($quantity === 0) {
            Cart::remove($productId);
            $message = 'Item removed from cart';
        } else {
            $product = $this->productService->getProductById($productId);
            
            if ($product && $product->quantity < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock. Available: ' . $product->quantity,
                ], 400);
            }

            Cart::update($productId, [
                'quantity' => $quantity,
            ]);
            $message = 'Item quantity updated successfully';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => [
                'total_quantity' => Cart::getTotalQuantity(),
                'item_count' => Cart::getContent()->count(),
            ],
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove(int $productId): JsonResponse
    {
        $item = Cart::get($productId);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart',
            ], 404);
        }

        Cart::remove($productId);

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart successfully',
            'data' => [
                'total_quantity' => Cart::getTotalQuantity(),
                'item_count' => Cart::getContent()->count(),
            ],
        ]);
    }

    /**
     * Clear cart
     */
    public function clear(): JsonResponse
    {
        Cart::clear();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully',
        ]);
    }

    /**
     * Get cart summary
     */
    public function summary(): JsonResponse
    {
        $total = Cart::getTotal();
        $totalQuantity = Cart::getTotalQuantity();
        $itemCount = Cart::getContent()->count();

        return response()->json([
            'success' => true,
            'message' => 'Cart summary retrieved successfully',
            'data' => [
                'total' => $total,
                'total_quantity' => $totalQuantity,
                'item_count' => $itemCount,
                'is_empty' => $itemCount === 0,
            ],
        ]);
    }
}

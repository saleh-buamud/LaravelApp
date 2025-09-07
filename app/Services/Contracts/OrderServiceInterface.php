<?php

namespace App\Services\Contracts;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrderServiceInterface
{
    /**
     * Get all orders with pagination
     */
    public function getAllOrders(int $perPage = 15): LengthAwarePaginator;

    /**
     * Get order by ID
     */
    public function getOrderById(int $id): ?Order;

    /**
     * Get orders by user ID
     */
    public function getOrdersByUserId(int $userId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Create a new order
     */
    public function createOrder(array $data): Order;

    /**
     * Update order status
     */
    public function updateOrderStatus(int $id, int $status): bool;

    /**
     * Delete an order
     */
    public function deleteOrder(int $id): bool;

    /**
     * Get order with details
     */
    public function getOrderWithDetails(int $id): ?Order;
}

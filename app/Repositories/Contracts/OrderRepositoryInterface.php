<?php

namespace App\Repositories\Contracts;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    /**
     * Get all orders with pagination
     */
    public function getAll(int $perPage = 15): LengthAwarePaginator;

    /**
     * Get order by ID
     */
    public function findById(int $id): ?Order;

    /**
     * Get orders by user ID
     */
    public function getByUserId(int $userId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Create a new order
     */
    public function create(array $data): Order;

    /**
     * Update order status
     */
    public function updateStatus(int $id, int $status): bool;

    /**
     * Delete an order
     */
    public function delete(int $id): bool;

    /**
     * Get order with details
     */
    public function findWithDetails(int $id): ?Order;
}

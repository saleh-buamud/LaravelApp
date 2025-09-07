<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderRepository implements OrderRepositoryInterface
{
    protected Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * Get all orders with pagination
     */
    public function getAll(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->with(['user', 'orderDet.product'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get order by ID
     */
    public function findById(int $id): ?Order
    {
        return $this->model->with(['user', 'orderDet.product'])->find($id);
    }

    /**
     * Get orders by user ID
     */
    public function getByUserId(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->where('user_id', $userId)
            ->with(['orderDet.product'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Create a new order
     */
    public function create(array $data): Order
    {
        return $this->model->create($data);
    }

    /**
     * Update order status
     */
    public function updateStatus(int $id, int $status): bool
    {
        $order = $this->findById($id);
        
        if (!$order) {
            return false;
        }

        return $order->update(['status' => $status]);
    }

    /**
     * Delete an order
     */
    public function delete(int $id): bool
    {
        $order = $this->findById($id);
        
        if (!$order) {
            return false;
        }

        return $order->delete();
    }

    /**
     * Get order with details
     */
    public function findWithDetails(int $id): ?Order
    {
        return $this->model
            ->with(['user', 'orderDet.product.subCategory.category'])
            ->find($id);
    }
}

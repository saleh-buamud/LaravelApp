<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDet;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class OrderService implements OrderServiceInterface
{
    protected OrderRepositoryInterface $orderRepository;
    protected ProductRepositoryInterface $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Get all orders with pagination
     */
    public function getAllOrders(int $perPage = 15): LengthAwarePaginator
    {
        return $this->orderRepository->getAll($perPage);
    }

    /**
     * Get order by ID
     */
    public function getOrderById(int $id): ?Order
    {
        return $this->orderRepository->findById($id);
    }

    /**
     * Get orders by user ID
     */
    public function getOrdersByUserId(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->orderRepository->getByUserId($userId, $perPage);
    }

    /**
     * Create a new order
     */
    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            // Create the order
            $order = $this->orderRepository->create($data);

            // Create order details and update product quantities
            $orderDetails = [];
            foreach ($data['items'] as $item) {
                // Create order detail
                $orderDetail = OrderDet::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Update product quantity
                $product = $this->productRepository->findById($item['product_id']);
                if ($product) {
                    $newQuantity = $product->quantity - $item['quantity'];
                    $this->productRepository->updateQuantity($item['product_id'], $newQuantity);
                }

                $orderDetails[] = $orderDetail;
            }

            // Send email notifications
            $this->sendOrderNotifications($order, $orderDetails);

            return $order;
        });
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(int $id, int $status): bool
    {
        return $this->orderRepository->updateStatus($id, $status);
    }

    /**
     * Delete an order
     */
    public function deleteOrder(int $id): bool
    {
        return $this->orderRepository->delete($id);
    }

    /**
     * Get order with details
     */
    public function getOrderWithDetails(int $id): ?Order
    {
        return $this->orderRepository->findWithDetails($id);
    }

    /**
     * Send order notification emails
     */
    protected function sendOrderNotifications(Order $order, array $orderDetails): void
    {
        // Send email to customer
        if ($order->user && $order->user->email) {
            Mail::to($order->user->email)->send(new TestMail($order, $orderDetails));
        }

        // Send email to store owner
        Mail::to('buamudsaleh@gmail.com')->send(new TestMail($order, $orderDetails));
    }
}

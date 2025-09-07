<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'order_date',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'total_amount' => 'decimal:2',
        'status' => 'integer',
    ];

    /**
     * Get the user that owns the order
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin that owns the order
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the order details for the order
     */
    public function orderDet(): HasMany
    {
        return $this->hasMany(OrderDet::class);
    }

    /**
     * Get the order details for the order (alias)
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDet::class);
    }

    /**
     * Get the status text
     */
    public function getStatusTextAttribute(): string
    {
        return match ($this->status) {
            1 => 'Pending',
            2 => 'Processing',
            3 => 'Shipped',
            4 => 'Delivered',
            5 => 'Cancelled',
            default => 'Unknown',
        };
    }

    /**
     * Check if order is pending
     */
    public function isPending(): bool
    {
        return $this->status === 1;
    }

    /**
     * Check if order is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 4;
    }

    /**
     * Check if order is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->status === 5;
    }
}

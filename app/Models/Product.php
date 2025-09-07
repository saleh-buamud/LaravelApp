<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'image',
        'sub_category_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * Get the subcategory that owns the product
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    /**
     * Get the modes associated with the product
     */
    public function modes(): BelongsToMany
    {
        return $this->belongsToMany(Mode::class, 'product_model', 'product_id', 'mode_id');
    }

    /**
     * Get the order details for the product
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDet::class);
    }

    /**
     * Scope a query to search products by name or description
     */
    public function scopeSearch($query, string $keyword)
    {
        return $query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
    }

    /**
     * Scope a query to get low stock products
     */
    public function scopeLowStock($query, int $threshold = 5)
    {
        return $query->where('quantity', '<', $threshold);
    }

    /**
     * Get the full image URL
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    /**
     * Check if product is in stock
     */
    public function isInStock(): bool
    {
        return $this->quantity > 0;
    }

    /**
     * Check if product is low stock
     */
    public function isLowStock(int $threshold = 5): bool
    {
        return $this->quantity < $threshold;
    }
}

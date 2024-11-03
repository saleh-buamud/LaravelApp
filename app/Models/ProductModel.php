<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
     $guarded = [];
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_model', 'model_id', 'product_id');
    }
}

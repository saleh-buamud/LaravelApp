<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
     $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Mode::class, 'product_model', 'mode_id', 'product_id');
    }
}

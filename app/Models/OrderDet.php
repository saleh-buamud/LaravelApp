<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDet extends Model
{
     $guarded = [];
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // علاقة "واحد إلى متعدد" مع Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

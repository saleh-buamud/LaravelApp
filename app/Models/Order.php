<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
       $guarded = [];
    use HasFactory;
     $guarded = [];

    public function OrderDet()
    {
        return $this->hasMany(OrderDet::class);
    }
}
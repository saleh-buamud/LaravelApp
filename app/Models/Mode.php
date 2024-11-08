<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'make_id'];
    protected $table = 'modes'; // تحديد اسم الجدول الصحيح

    // العلاقة بين Mode و Make
    public function make()
    {
        return $this->belongsTo(Make::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_model', 'mode_id', 'product_id');
    }
}

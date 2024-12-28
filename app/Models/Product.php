<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'quantity', 'price', 'image', 'sub_category_id'];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    // علاقة "ميني تو ميني" مع ProductModels
    // public function models()
    // {
    //     return $this->belongsToMany(ProductModel::class, 'product_model', 'product_id', 'model_id');
    // }
    public function modes()
    {
        return $this->belongsToMany(Mode::class, 'product_model', 'product_id', 'mode_id');
    }
}

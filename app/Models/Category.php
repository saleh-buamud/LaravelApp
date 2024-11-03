<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'category_id'];

    use HasFactory;
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMode extends Model
{
    use HasFactory;
    protected $table = 'product_model'; // تحديد اسم الجدول

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'name', // يمكنك إضافة أي حقول أخرى تريدها قابلة للتعبئة
    ];

    // العلاقة مع الـ Products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_model', 'mode_id', 'product_id');
    }
}

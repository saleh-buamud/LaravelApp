<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function rules($id = 0, $img = null)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                "unique:categories,name,$id",
                function ($attribute, $value, $fail) {
                    // قائمة الكلمات المحظورة
                    $words = ['laravel', 'php', 'html', 'css']; // استبدل هذه القيم بالكلمات التي تريد التحقق منها
 
                    // تحويل القيمة المدخلة والكلمات المحظورة إلى حروف صغيرة للتحقق غير الحساس لحالة الأحرف
                    if (in_array(strtolower($value), array_map('strtolower', $words))) {
                        // إذا كانت القيمة المدخلة تحتوي على كلمة محظورة، قم بإرجاع رسالة خطأ
                        $fail('The ' . $attribute . ' contains a prohibited word.');
                    }
                },
            ],

            'parent_id' => ['nullable', 'exists:categories,id'],
            'image' => $img ? 'nullable|image|max:2048' : 'required|image|max:2048', // الصورة مطلوبة فقط عند الإنشاء
            'status' => 'required|in:Active,inactive',
        ];
    }
}

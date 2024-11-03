<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // مفتاح أساسي
            $table->string('name'); // اسم المنتج
            $table->foreignId('sub_category_id')->constrained()->onDelete('cascade'); // مفتاح خارجي لفئة فرعية
            $table->text('description')->nullable(); // وصف المنتج (يمكن أن يكون فارغًا)
            $table->string('image')->nullable(); // رابط الصورة (يمكن أن يكون فارغًا)
            $table->double('price', 8, 2); // سعر المنتج (تحديد دقة الرقم العشري)
            $table->integer('quantity')->default(0); // كمية المنتج (قيمة افتراضية 0)
            $table->timestamps(); // تواريخ الإنشاء والتحديث
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

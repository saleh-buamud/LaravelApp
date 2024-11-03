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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // مفتاح أساسي
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // مفتاح خارجي للمستخدم
            $table->date('order_date'); // تاريخ الطلب
            $table->float('total_amount', 8, 2); // المبلغ الإجمالي
            $table->boolean('status'); // حالة الطلب (true أو false)
            $table->timestamps(); // تواريخ الإنشاء والتحديث
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

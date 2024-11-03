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
        Schema::create('sub_categories', function (Blueprint $table) {
        $table->id(); // مفتاح أساسي
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // مفتاح خارجي
            $table->string('name'); // اسم الفئة الفرعية
            $table->text('description')->nullable(); // وصف الفئة الفرعية
            $table->timestamps(); // تواريخ الإنشاء والتحديث
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // مفتاح أساسي
            $table->string('name'); // اسم الفئة
            $table->text('description')->nullable(); // وصف الفئة
            $table->timestamps(); // تواريخ الإنشاء والتحديث
        });

        // إدخال القيم الثابتة
       DB::table('categories')->insert([
    ['name' => 'Internal-Parts', 'description' => 'Internal parts for vehicles'], // قطع غيار داخلية
    ['name' => 'External-Parts', 'description' => 'External parts for vehicles'], // قطع غيار خارجية
    ['name' => 'Electrical-Parts', 'description' => 'Electrical parts for vehicles'], // قطع غيار كهربائية
]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories'); // حذف الجدول عند التراجع
    }
};

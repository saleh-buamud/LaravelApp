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
        Schema::table('order_dets', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('phone')->nullable(); // هذا السطر كان يحتوي على $$table
            $table->string('address')->nullable();
            $table->string('city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_dets', function (Blueprint $table) {
            $table->dropColumn(['name', 'phone', 'address', 'city']); // أضف حذف الأعمدة في حالة التراجع
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            // $table->decimal('discount')->nullable();
            $table->integer('discount_percentage')->nullable();
            // $table->date('expire_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('limit')->nullable(); //  $table->integer('max_usage')->default(100); // الحد الأقصى للاستخدام (100)
            $table->integer('time_used')->default(0); // عدد مرات الاستخدام الفعلي
            $table->boolean('is_active')->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};

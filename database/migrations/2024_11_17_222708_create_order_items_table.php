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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->longText('product_desc');
            $table->integer('product_quantity');
            $table->decimal('product_price');
            $table->json('attributes')->nullable();

            $table->foreignId("product_variant_id")->nullable()->constrained()->onDelete('cascade')->onUpdate("cascade");

            $table->foreignId("product_id")->nullable()->constrained()->onDelete('cascade')->onUpdate("cascade");
            $table->foreignId("order_id")->constrained()->onDelete('cascade')->onUpdate("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

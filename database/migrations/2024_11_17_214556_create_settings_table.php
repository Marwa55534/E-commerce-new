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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->text('site_desc');
            $table->string('email');
            $table->string('email_support',500);
            $table->string('phone');
            $table->string('address');
            $table->string('facebook',500);
            $table->string('twitter',500);
            $table->string('youtupe',500);
            $table->string('meta_description',160);
            $table->string('logo');
            $table->string('favicon');
            $table->string('site_copyright');
            $table->string('promotion_video_url',1000); 


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

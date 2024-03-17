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
        Schema::create('address_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_data_id')->references('id')->on('address_data');
            $table->string('description');
            $table->string('image_url');
            $table->timestamps();
            $table->boolean('archived')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_images');
    }
};

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
        Schema::create('address_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_data_id')->references('id')->on('address_data');
            $table->foreignId('doorknock_response')->references('id')->on('doorknock_responses');
            $table->string('response_explanation')->default('');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_visits');
    }
};

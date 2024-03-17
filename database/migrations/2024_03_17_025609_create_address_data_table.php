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
        Schema::create('address_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_list_id')->references('id')->on('address_lists');
            $table->string('address');
            $table->integer('postcode');
            $table->string('name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('landlord')->nullable();
            $table->longText('issues')->nullable();
            $table->string('support_level_explanation')->nullable();
            $table->string('interested_in')->nullable();
            $table->timestamps();
            $table->boolean('archived')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_data');
    }
};

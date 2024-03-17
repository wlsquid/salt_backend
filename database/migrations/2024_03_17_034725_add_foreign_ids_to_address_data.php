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
        Schema::table('address_data', function (Blueprint $table) {
            $table->foreignId('support_level_id')
            ->after('issues')->nullable()->references('id')
            ->on('support_levels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('address_data', function (Blueprint $table) {
            $table->dropColumn('support_level_id');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $responseTypes = [
            ['description' => 'Meaningful'],
            ['description' => 'No Answer'],
            ['description' => 'Busy'],
            ['description' => 'Not Interested'],
            ['description' => 'Inaccessible'], 
            ['description' => 'Bad Info'], 
            ['description' => 'Refused'],
        ];

        $supportLevels = [
            ['description' => 'Hostile'],
            ['description' => 'Neutral (no issues)'],
            ['description' => 'Interested But Hesitant'],
            ['description' => 'Interested But Has Some Barriers'],
            ['description' => 'Keen to get involved'],
        ];

        // Insert lookup values into tables        
        DB::table('doorknock_responses')->insert($responseTypes);
        DB::table('support_levels')->insert($supportLevels);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

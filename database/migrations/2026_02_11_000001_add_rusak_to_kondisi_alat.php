<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify the enum to include 'rusak' option
        DB::statement("ALTER TABLE alat MODIFY COLUMN kondisi ENUM('baik', 'rusak_ringan', 'rusak') DEFAULT 'baik'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First update any 'rusak' values to 'rusak_ringan' before removing the enum value
        DB::table('alat')->where('kondisi', 'rusak')->update(['kondisi' => 'rusak_ringan']);
        
        // Revert back to original enum values
        DB::statement("ALTER TABLE alat MODIFY COLUMN kondisi ENUM('baik', 'rusak_ringan') DEFAULT 'baik'");
    }
};

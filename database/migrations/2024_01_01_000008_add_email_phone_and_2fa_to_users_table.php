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
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique()->after('username');
            $table->string('nomor_telepon')->nullable()->after('email');
            $table->boolean('two_fa_enabled')->default(false)->after('nomor_telepon');
            $table->string('two_fa_code')->nullable()->after('two_fa_enabled');
            $table->timestamp('two_fa_code_expires_at')->nullable()->after('two_fa_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['email', 'nomor_telepon', 'two_fa_enabled', 'two_fa_code', 'two_fa_code_expires_at']);
        });
    }
};

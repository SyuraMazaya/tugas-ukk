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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjaman', 'id_peminjaman')->onDelete('restrict');
            $table->date('tanggal_kembali_real');
            $table->decimal('denda', 12, 2)->default(0);
            $table->text('catatan_kondisi')->nullable();
            $table->foreignId('petugas_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();

            $table->index('peminjaman_id');
            $table->index('petugas_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};

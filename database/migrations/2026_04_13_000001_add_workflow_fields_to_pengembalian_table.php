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
        Schema::table('pengembalian', function (Blueprint $table) {
            $table->foreignId('petugas_id')->nullable()->change();
            $table->boolean('denda_lunas')->default(true)->after('denda');
            $table->string('status', 50)->default('selesai')->after('denda_lunas');
            $table->text('catatan_peminjam')->nullable()->after('catatan_kondisi');
            $table->text('catatan_approval')->nullable()->after('catatan_peminjam');
            $table->string('metode_pembayaran', 20)->nullable()->after('catatan_approval');
            $table->string('bukti_pembayaran')->nullable()->after('metode_pembayaran');
            $table->dateTime('tanggal_pembayaran')->nullable()->after('bukti_pembayaran');
            $table->foreignId('diverifikasi_oleh')->nullable()->after('petugas_id')->constrained('users')->restrictOnDelete();
            $table->dateTime('tanggal_verifikasi')->nullable()->after('diverifikasi_oleh');

            $table->index('status');
            $table->index('denda_lunas');
        });

        // Existing records are legacy completed returns.
        DB::table('pengembalian')->update([
            'status' => 'selesai',
            'denda_lunas' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $fallbackUserId = DB::table('users')->min('id');

        if ($fallbackUserId !== null) {
            DB::table('pengembalian')
                ->whereNull('petugas_id')
                ->update(['petugas_id' => $fallbackUserId]);
        }

        Schema::table('pengembalian', function (Blueprint $table) {
            $table->dropForeign(['diverifikasi_oleh']);
            $table->dropIndex(['status']);
            $table->dropIndex(['denda_lunas']);

            $table->dropColumn([
                'denda_lunas',
                'status',
                'catatan_peminjam',
                'catatan_approval',
                'metode_pembayaran',
                'bukti_pembayaran',
                'tanggal_pembayaran',
                'diverifikasi_oleh',
                'tanggal_verifikasi',
            ]);

            $table->foreignId('petugas_id')->nullable(false)->change();
        });
    }
};

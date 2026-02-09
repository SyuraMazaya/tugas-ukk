<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali_real',
        'denda',
        'catatan_kondisi',
        'petugas_id',
    ];

    protected $casts = [
        'tanggal_kembali_real' => 'date',
        'denda' => 'decimal:2',
    ];

    /**
     * Get the peminjaman that this pengembalian belongs to.
     */
    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'id_peminjaman');
    }

    /**
     * Get the petugas that processed this pengembalian.
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    /**
     * Calculate late days.
     */
    public function getHariTerlambatAttribute(): int
    {
        if (!$this->peminjaman) {
            return 0;
        }

        $tanggalRencana = $this->peminjaman->tanggal_kembali_rencana;
        $tanggalReal = $this->tanggal_kembali_real;

        if ($tanggalReal->gt($tanggalRencana)) {
            return $tanggalReal->diffInDays($tanggalRencana);
        }

        return 0;
    }

    /**
     * Get formatted denda.
     */
    public function getDendaFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->denda, 0, ',', '.');
    }
}

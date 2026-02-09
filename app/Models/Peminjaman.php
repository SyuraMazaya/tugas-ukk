<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'user_id',
        'petugas_id',
        'tanggal_pinjam',
        'tanggal_kembali_rencana',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali_rencana' => 'date',
    ];

    /**
     * Get the user (peminjam) that owns this peminjaman.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Alias for user relationship - more semantic.
     */
    public function peminjam(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the petugas that approved this peminjaman.
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    /**
     * Get all detail peminjaman.
     */
    public function detailPeminjaman(): HasMany
    {
        return $this->hasMany(DetailPeminjaman::class, 'peminjaman_id', 'id_peminjaman');
    }

    /**
     * Get the pengembalian record.
     */
    public function pengembalian(): HasOne
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id', 'id_peminjaman');
    }

    /**
     * Get status label with badge color.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Persetujuan',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            'selesai' => 'Selesai',
            'batal' => 'Dibatalkan',
            default => $this->status,
        };
    }

    /**
     * Get status badge color class.
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'disetujui' => 'bg-blue-100 text-blue-800',
            'ditolak' => 'bg-red-100 text-red-800',
            'selesai' => 'bg-green-100 text-green-800',
            'batal' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Check if peminjaman is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if peminjaman is approved.
     */
    public function isDisetujui(): bool
    {
        return $this->status === 'disetujui';
    }

    /**
     * Check if peminjaman can be returned.
     */
    public function canBeReturned(): bool
    {
        return $this->status === 'disetujui';
    }
}

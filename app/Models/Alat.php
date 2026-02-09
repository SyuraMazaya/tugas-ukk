<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';
    protected $primaryKey = 'id_alat';

    protected $fillable = [
        'kategori_id',
        'nama_alat',
        'kode_alat',
        'stok',
        'gambar',
        'kondisi',
    ];

    protected $casts = [
        'stok' => 'integer',
    ];

    /**
     * Get the kategori that owns this alat.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    /**
     * Get all detail peminjaman for this alat.
     */
    public function detailPeminjaman(): HasMany
    {
        return $this->hasMany(DetailPeminjaman::class, 'alat_id', 'id_alat');
    }

    /**
     * Check if stock is available for given quantity.
     */
    public function isStokTersedia(int $jumlah): bool
    {
        return $this->stok >= $jumlah;
    }

    /**
     * Get kondisi label.
     */
    public function getKondisiLabelAttribute(): string
    {
        return match ($this->kondisi) {
            'baik' => 'Baik',
            'rusak_ringan' => 'Rusak Ringan',
            default => $this->kondisi,
        };
    }
}

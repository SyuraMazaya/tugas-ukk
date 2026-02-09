<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman';

    protected $fillable = [
        'peminjaman_id',
        'alat_id',
        'jumlah',
    ];

    protected $casts = [
        'jumlah' => 'integer',
    ];

    /**
     * Get the peminjaman that owns this detail.
     */
    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'id_peminjaman');
    }

    /**
     * Get the alat for this detail.
     */
    public function alat(): BelongsTo
    {
        return $this->belongsTo(Alat::class, 'alat_id', 'id_alat');
    }
}

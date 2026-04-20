<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali_real',
        'denda',
        'denda_lunas',
        'status',
        'catatan_kondisi',
        'catatan_peminjam',
        'catatan_approval',
        'metode_pembayaran',
        'bukti_pembayaran',
        'tanggal_pembayaran',
        'petugas_id',
        'diverifikasi_oleh',
        'tanggal_verifikasi',
    ];

    protected $casts = [
        'tanggal_kembali_real' => 'date',
        'tanggal_pembayaran' => 'datetime',
        'tanggal_verifikasi' => 'datetime',
        'denda' => 'decimal:2',
        'denda_lunas' => 'boolean',
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
     * Get the petugas that verified payment.
     */
    public function verifikator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

    /**
     * Calculate late days.
     */
    public function getHariTerlambatAttribute(): int
    {
        if (! $this->peminjaman) {
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
        return 'Rp '.number_format($this->denda, 0, ',', '.');
    }

    /**
     * Get status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu_approval' => 'Menunggu Approval Pengembalian',
            'menunggu_pembayaran' => 'Menunggu Pembayaran Denda',
            'menunggu_verifikasi_pembayaran' => 'Menunggu Verifikasi Pembayaran',
            'selesai' => 'Clear',
            default => $this->status,
        };
    }

    /**
     * Get payment method label.
     */
    public function getMetodePembayaranLabelAttribute(): string
    {
        return match ($this->metode_pembayaran) {
            'tunai' => 'Tunai',
            'qris' => 'QRIS',
            default => '-',
        };
    }

    /**
     * Check if status is waiting for approval.
     */
    public function isMenungguApproval(): bool
    {
        return $this->status === 'menunggu_approval';
    }

    /**
     * Check if status is waiting for payment.
     */
    public function isMenungguPembayaran(): bool
    {
        return $this->status === 'menunggu_pembayaran';
    }

    /**
     * Check if status is waiting for payment verification.
     */
    public function isMenungguVerifikasiPembayaran(): bool
    {
        return $this->status === 'menunggu_verifikasi_pembayaran';
    }

    /**
     * Check if workflow is clear.
     */
    public function isSelesai(): bool
    {
        return $this->status === 'selesai';
    }
}

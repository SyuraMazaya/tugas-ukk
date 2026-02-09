<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get the role that owns this user.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get all peminjaman created by this user.
     */
    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'user_id');
    }

    /**
     * Get all peminjaman approved by this user (as petugas).
     */
    public function peminjamanDisetujui(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'petugas_id');
    }

    /**
     * Get all pengembalian processed by this user (as petugas).
     */
    public function pengembalianDiproses(): HasMany
    {
        return $this->hasMany(Pengembalian::class, 'petugas_id');
    }

    /**
     * Get all activity logs for this user.
     */
    public function logAktivitas(): HasMany
    {
        return $this->hasMany(LogAktivitas::class, 'user_id');
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role?->name === 'admin';
    }

    /**
     * Check if user is petugas.
     */
    public function isPetugas(): bool
    {
        return $this->role?->name === 'petugas';
    }

    /**
     * Check if user is peminjam.
     */
    public function isPeminjam(): bool
    {
        return $this->role?->name === 'peminjam';
    }

    /**
     * Check if user has any of the given roles.
     */
    public function hasRole(string|array $roles): bool
    {
        $roles = is_array($roles) ? $roles : [$roles];
        return in_array($this->role?->name, $roles);
    }
}

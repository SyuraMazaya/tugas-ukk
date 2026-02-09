<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $fillable = [
        'nama_denda',
        'deskripsi',
        'jumlah_denda',
        'is_active',
    ];

    protected $casts = [
        'jumlah_denda' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}

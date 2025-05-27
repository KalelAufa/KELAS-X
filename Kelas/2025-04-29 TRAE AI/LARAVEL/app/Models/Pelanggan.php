<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    /** @use HasFactory<\Database\Factories\PelangganFactory> */
    protected $fillable = [
        'pelanggan',
        'alamat',
        'telp',
        'email',
        'password',
        'aktif',
    ];
}

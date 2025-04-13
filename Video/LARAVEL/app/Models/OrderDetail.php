<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /** @use HasFactory<\Database\Factories\OrderDetailFactory> */
    use HasFactory;
    protected $fillable = [
        'idorder',
        'idmenu', // Ensure idmenu is fillable
        'idpelanggan',
        'tglorder',
        'jumlah',
        'hargajual',
    ];
}

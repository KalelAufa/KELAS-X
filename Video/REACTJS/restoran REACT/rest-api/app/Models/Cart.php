<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $primaryKey = 'idcart';
    protected $fillable = ['idpelanggan', 'idmenu', 'jumlah', 'catatan'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'idpelanggan');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'idmenu');
    }
}

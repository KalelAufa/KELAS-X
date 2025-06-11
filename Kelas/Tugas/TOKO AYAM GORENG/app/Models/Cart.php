<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'menu_id',
        'session_id',
        'quantity'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}

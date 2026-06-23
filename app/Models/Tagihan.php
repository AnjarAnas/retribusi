<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $guarded = [];
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}

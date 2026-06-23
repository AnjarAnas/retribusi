<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogTagihan extends Model
{
    protected $guarded = [];
    protected $casts = [
        'total' => 'integer',
    ];
    function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}

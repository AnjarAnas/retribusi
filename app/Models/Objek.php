<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objek extends Model
{
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tipe()
    {
        return $this->belongsTo(Tipe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transakti()
    {
        return $this->hasMany(Transaksi::class);
    }
}

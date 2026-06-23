<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}

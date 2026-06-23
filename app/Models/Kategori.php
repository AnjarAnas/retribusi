<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $guarded = [];

    public function objek()
    {
        return $this->hasMany(Objek::class);
    }
}

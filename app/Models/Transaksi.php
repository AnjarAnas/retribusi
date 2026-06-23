<?php

namespace App\Models;

use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];
    protected $appends = ['bayarTotal', 'bulanTagihan', 'totalBayarLog'];

    public function objek()
    {
        return $this->belongsTo(Objek::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }
    function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }
    function logTagihan()
    {
        return $this->hasMany(LogTagihan::class);
    }
    function getBayarTotalAttribute()
    {
        return $this->tagihan()->sum('total');
    }
    function getTotalBayarLogAttribute()
    {
        return $this->logTagihan->sum('total');
    }
    function getBulanTagihanAttribute()
    {
        $nama = "Bulan ";
        foreach ($this->tagihan()->get() as $key => $value) {
            if ($key == count($this->tagihan()->get()) - 1) {
                $koma = "";
            } else {
                $koma = ', ';
            }
            $nama .= Helper::convertBulanSaja($value->bulan) . $koma;
        }
        return $nama;
    }
}

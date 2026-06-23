<?php

namespace App\Http\Helpers;

class Helper
{
    static function convertBulan($bulanTahun)
    {
        $pecah = explode('-', $bulanTahun);
        return Self::bulan($pecah[0]) . ' ' . $pecah[1];
    }
    static function convertBulanSaja($bulan)
    {
        return Self::bulan($bulan);
    }
    static function bulan($bulan)
    {
        $a = '';
        if ($bulan == 1) {
            $a = 'Januari';
        } elseif ($bulan == 2) {
            $a = 'Februari';
        } elseif ($bulan == 3) {
            $a = 'Maret';
        } elseif ($bulan == 4) {
            $a = 'April';
        } elseif ($bulan == 5) {
            $a = 'Mei';
        } elseif ($bulan == 6) {
            $a = 'Juni';
        } elseif ($bulan == 7) {
            $a = 'Juli';
        } elseif ($bulan == 8) {
            $a = 'Agustus';
        } elseif ($bulan == 9) {
            $a = 'September';
        } elseif ($bulan == 10) {
            $a = 'Oktober';
        } elseif ($bulan == 11) {
            $a = 'November';
        } elseif ($bulan == 12) {
            $a = 'Desember';
        }
        return $a;
    }
}

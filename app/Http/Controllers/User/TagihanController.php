<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Models\LogTagihan;
use App\Models\Objek;
use App\Models\Tagihan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TagihanController extends Controller
{
    function listTagihan()
    {
        $array = [];
        $kurang = [];
        for ($i = 1; $i <= 12; $i++) {
            $getTagihan = Tagihan::query()->where([['bulan', $i], ['tahun', date('Y')]])->first();

            $hari = cal_days_in_month(CAL_GREGORIAN, $i, date('Y'));
            if ($getTagihan) {
                if ($getTagihan->kurang > 0) {
                    $kurang[] = $getTagihan->kurang;
                } else {
                    $kurang[] = 0;
                }
            } else {
                $kurang[] = 0;
            }
            if ($getTagihan) {

                if ($getTagihan->kurang < 1) {
                    $array[] = [
                        'bulan' => $i,
                        'tanggal' => Helper::convertBulan($i . '-' . date('Y')),
                        'status' => 'Lunas',
                        'bulan_ini' => date('n') == $i ? true : false,
                        'harga' => $hari * Auth::user()->objek->tipe->harga,
                        'kurang' => $kurang[0]
                    ];
                } else {
                    $array[] = [
                        'bulan' => $i,
                        'tanggal' => Helper::convertBulan($i . '-' . date('Y')),
                        'status' => 'Belum Lunas',
                        'bulan_ini' => date('n') == $i ? true : false,
                        'harga' => $hari * Auth::user()->objek->tipe->harga,
                        'kurang' => $kurang[$i - 2]

                    ];
                }
            } else {
                $array[] = [
                    'bulan' => $i,
                    'tanggal' => Helper::convertBulan($i . '-' . date('Y')),
                    'status' => 'Belum Bayar',
                    'bulan_ini' => date('n') == $i ? true : false,
                    'harga' => $hari * Auth::user()->objek->tipe->harga,
                    'kurang' => $kurang[$i - 2]
                ];
            }
        }
        // return $kurang;
        return response()->json(['success' => true, 'tagihan' => $array]);
    }
    function listTransaksi(Request $req)
    {
        $transaksi = Transaksi::get();
        return response()->json(['success' => true, 'message' => 'berhasil', 'transaksi' => $transaksi]);
    }
    function detailTransaksi(Request $req)
    {
        $detail = Transaksi::with('logTagihan')->where('id', $req->id)->first();
        $getTransaksiTerakhir = Transaksi::query()->where('status', 'settlement')->whereHas('objek', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->orderBy('id', 'desc')->first();
        if ($getTransaksiTerakhir) {
            if ($getTransaksiTerakhir->id == $detail->id) {
                if ($detail->kurang < 1) {
                    $detail->islunas = true;
                } else {
                    $detail->islunas = false;
                }
            } else {
                $detail->islunas = true;
            }
        }
        // return $getTransaksiTerakhir;
        return response()->json(['success' => true, 'message' => 'berhasil', 'detail' => $detail]);
    }
    function bayar(Request $req)
    {
        $a = [];
        for ($i = 1; $i <= $req->bulan; $i++) {
            $a[] = '' . $i;
        }
        $getTagihanAda = Tagihan::whereIn('bulan', $a)->pluck('bulan')->toArray();
        $array = array_merge($a, $getTagihanAda);
        // dd($a, $getTagihanAda);
        $b = [];
        foreach ($a as $key => $value) {
            if (!in_array($value, $getTagihanAda)) {
                $b[] = $a;
            }
        }
        // return $array;
        // return array_unique($array);
        $tokoBayar = (int) $req->bayar;
        $getObjek = Objek::query()->with('tipe')->where('user_id', Auth::user()->id)->first();
        $harga = 0;
        $item = [];
        $itemSplit = [];
        $getTagihan = Tagihan::where([['status', true], ['user_id', Auth::user()->id]])->orderBy('id', 'desc')->first();
        // return $getTagihan;
        foreach ($req->bulan as $key => $value) {
            $tagihan = Tagihan::where('bulan', $value)->where('tahun', date('Y'))->first();
            if ($tagihan) {
                return response()->json(['success' => false, 'message' => 'Bulan sudah ada']);
            }
            $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $value, date('Y'));
            $harga += $jumlahHari * $getObjek->tipe->harga;
            $itemSplit[] = $jumlahHari * $getObjek->tipe->harga;
            // $a[] = $harga;
        }
        if ($tokoBayar > $harga) {
            return response()->json(['success' => false, 'message' => 'Bayar tidak boleh lebih dari total bayar Rp.' . number_format($harga)]);
        }
        // return $itemSplit;
        $selisih = $harga - $tokoBayar;
        if ($tokoBayar % $getObjek->tipe->harga != 0) {
            return response()->json(['success' => false, 'message' => 'Nominal harus kelipatan ' . $getObjek->tipe->harga]);
        }
        // return $itemSplit;
        array_pop($itemSplit);
        $selisihTerakhir = $tokoBayar - array_sum($itemSplit);
        if ($tokoBayar <= array_sum($itemSplit)) {
            return response()->json(['success' => false, 'message' => 'Nominal harus lebih dari pembayaran ' . count($req->bulan) . '. total ' . array_sum($itemSplit)]);
        }
        DB::beginTransaction();
        $order_id = Str::uuid();

        $itemSplit[] = $selisihTerakhir;
        $createdTransaksi = Transaksi::create([
            'objek_id' => $getObjek->id,
            'petugas_id' => 1,
            'total_bayar' => $harga,
            'kurang' => $selisih,
            'status' => 'pending',
            'uuid' => $order_id,
        ]);
        foreach ($itemSplit as $key => $itemItem) {
            $item[] = [
                'id' => Str::uuid(),
                'price' => $itemItem,
                'quantity' => 1,
                'name' => 'Retribusi Bulan ' . Helper::convertBulan((int)$req->bulan[$key] . '-' . date('Y')),
            ];
            if ($key + 1 == count($itemSplit)) {
                $kurang = $selisih;
            } else {
                $kurang = 0;
            }
            $createTagihan = Tagihan::create([
                'bulan' => $req->bulan[$key],
                'tahun' => date('Y'),
                'total' => $itemItem,
                'kurang' => $kurang,
                'user_id' => Auth::user()->id,
                'transaksi_id' => $createdTransaksi->id,
                'status' => false
            ]);
            $createLog = LogTagihan::create([
                'keterangan' => 'Bayar Retribusi Bulan ' . Helper::convertBulan($req->bulan[$key] . "-" . date('Y')),
                'transaksi_id' => $createdTransaksi->id,
                'total' => $itemItem
            ]);
        }
        $admin = 1000;
        if ($getTagihan) {
            $item[] = [
                'id' => Str::uuid(),
                'price' => $getTagihan->kurang,
                'quantity' => 1,
                'name' => 'Kurangan Bulan ' . Helper::convertBulan($getTagihan->bulan . "-" . $getTagihan->tahun),
            ];
            $createLog = LogTagihan::create([
                'keterangan' => 'Bayar Kurang Retribusi Bulan ' . Helper::convertBulan($getTagihan->bulan . "-" . date('Y')),
                'transaksi_id' => $createdTransaksi->id,
                'total' => $getTagihan->kurang
            ]);
            $kurangBayar = $getTagihan->kurang;
            // $getTagihan->kurang = 0;
            $getTagihan->save();
        } else {
            $kurangBayar = 0;
        }
        $item[] = [
            'id' => Str::uuid(),
            'price' => $admin,
            'quantity' => 1,
            'name' => 'Admin Midtrans',
        ];
        // return $item;
        // dd($tokoBayar, $admin, $kurangBayar, $item);
        // return $tokoBayar + $admin;
        $res = $this->bayarTagihan($order_id, $tokoBayar + $admin + $kurangBayar, $item, $getObjek->id);
        // return $res->json();
        if ($res->status() == 201) {
            if ($getTagihan) {
                $getTagihan->save();
            }
            Transaksi::query()->where('id', $createdTransaksi->id)->update([
                'url' => $res->json()['redirect_url']
            ]);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Transaksi berhasil dibuat', 'gateway' => $res->json()]);
        } else {
            return "oke";
        }
    }
    public function bayarTagihan($order_id, $total, $item, $objek_id)
    {
        try {
            $data = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $total,
                ],
                'item_details' => $item,
                'credit_card' => ['secure' => true],
                'enabled_payments' => 'gopay,shopeepay,qris,akulaku',
                'objek_id' => $objek_id,
                // 'petugas_id' => $petugas_id,
                'expiry' => [
                    'unit' => 'hour',
                    'duration' => 1,
                ],
            ];
            $res = Http::withHeaders([
                'authorization' => 'Basic U0ItTWlkLXNlcnZlci1aRUpaV2dkbGlvcFVLdUVaRlp2c1lzOEY6',
            ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $data);

            return $res;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    function transaksi() {}
}

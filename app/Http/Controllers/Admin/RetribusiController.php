<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Objek;
use App\Models\Tagihan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class RetribusiController extends Controller
{
    public function index()
    {
        return view('admin.retribusi');
    }

    public function scanner()
    {
        return view('admin.scan');
    }

    public function scan(Request $req)
    {
        $getTransaksi = Transaksi::whereDate('tanggal_bayar', date('Y-m-d'))->where('status', 'settlement')->first();
        if ($getTransaksi) {
            return response()->json(['success' => false, 'message' => 'Bulan sudah dibayar']);
        }
        $getObjek = Objek::with('tipe')->select(['acak1', 'acak2', 'acak3', 'kode', 'id', 'tipe_id'])->get();
        $data = [];
        foreach ($getObjek as $objek) {
            $strContain = Str::contains($req->input('id'), base64_encode($objek->acak1));
            $strContain1 = Str::contains($req->input('id'), base64_encode($objek->acak2));
            $strContain2 = Str::contains($req->input('id'), base64_encode($objek->acak3));
            if ($strContain && $strContain1 && $strContain2) {
                $data = $objek;
            }
        }
        $jumlahHariBulan = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $harga = $jumlahHariBulan * $data->tipe->harga;
        $getTransaksiSebelum = Transaksi::where([['objek_id', $data->id], ['kurang', '>', 0]])->whereDate('tanggal_bayar', '<', date('Y-m-d'))->sum('kurang');
        $item = [];
        $item[] = [
            'id' => Str::uuid(),
            'price' => $harga,
            'quantity' => 1,
            'name' => 'Retribusi bulan ' . date('F Y'),
        ];
        if ($getTransaksiSebelum > 0) {
            $item[] = [
                'id' => Str::uuid(),
                'price' => (int) $getTransaksiSebelum,
                'quantity' => 1,
                'name' => 'Kurang Bayar Bulan Sebelum',
            ];
        }
        $item[] = [
            'id' => Str::uuid(),
            'price' => 1000,
            'quantity' => 1,
            'name' => 'Admin Midtrans',
        ];

        // return $item;
        $order_id = Str::uuid();
        $res = $this->bayar($order_id, $harga + $getTransaksiSebelum, $item, $data->id, 1);

        if ($res->status() == 201) {
            $insertTransaksi = Transaksi::create([
                'objek_id' => $data->id,
                'petugas_id' => 1,
                'total_bayar' => $harga + $getTransaksiSebelum,
                'status' => 'pending',
                'uuid' => $order_id,
            ]);
            if ($insertTransaksi) {
                return response()->json(['success' => true, 'data' => $res->json()]);
            }
        }

        // return $getTransaksiSebelum + $harga;
    }

    public function bayar($order_id, $total, $item, $objek_id, $petugas_id)
    {
        try {
            $data = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $total + 1000,
                ],
                'item_details' => $item,
                'credit_card' => ['secure' => true],
                'enabled_payments' => 'gopay,shopeepay,qris,akulaku',
                'objek_id' => $objek_id,
                'petugas_id' => $petugas_id,
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

    public function callback(Request $req)
    {
        $order_id = $req->input('order_id');
        $status_code = $req->input('status_code');
        $transaction_status = $req->input('transaction_status');
        $getTransaksi = Transaksi::with('tagihan')->where('uuid', $order_id)->first();

        if ($getTransaksi) {
            $res = Http::withHeader('authorization', 'Basic U0ItTWlkLXNlcnZlci1aRUpaV2dkbGlvcFVLdUVaRlp2c1lzOEY6')->get('https://api.sandbox.midtrans.com/v2/' . $order_id . '/status')->json();
            if ($res['status_code'] == 200) {
                $getTransaksi->tanggal_bayar = $res['settlement_time'];
                $getTransaksi->status = $res['transaction_status'];
                if ($res['payment_type'] == 'bank_transfer') {
                    $getTransaksi->metode_bayar = $res['va_numbers'][0]['bank'];
                } else {
                    return 'gagal';
                }
                if ($transaction_status == 'settlement' && $getTransaksi->save()) {
                    $getTagihan = Tagihan::where([['status', true], ['user_id', $getTransaksi->objek->user_id]])->orderBy('id', 'desc')->first();
                    $getTagihan->kurang = 0;
                    $getTagihan->save();
                    foreach ($getTransaksi->tagihan as $key => $value) {
                        Tagihan::where('transaksi_id', $getTransaksi->id)->update([
                            'status' => true
                        ]);
                    }
                    return redirect('scanner')->with('success', 'Pembayaran Berhasil');
                }
            } else {
                return $res;
            }
        } else {
            return 'gagal';
        }
    }
}

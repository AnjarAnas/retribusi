<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tipe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TipeController extends Controller
{
    public function index(Request $req)
    {
        $data['tipe'] = Tipe::latest()->get(); // Example data

        return view('admin.tipe', $data);
    }

    public function store(Request $req)
    {
        $req->validate([
            'nama' => 'required|string',
            'harga' => 'string|required',
        ]);
        $create = Tipe::create([
            'nama' => $req->input('nama'),
            'harga' => $req->input('harga'),
            'uuid' => Str::uuid(),
        ]);
        if ($create) {
            return response()->json(['success' => true, 'message' => 'Tipe Berhasil Ditambahkan']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something when wrong!!']);
        }
    }

    public function update(Request $req)
    {
        $req->validate([
            'id' => 'required',
            'nama' => 'required|string',
            'harga' => 'integer|required',
        ]);
        $update = Tipe::where('id', $req->input('id'))->update([
            'nama' => $req->input('nama'),
            'harga' => $req->input('harga'),

        ]);
        if ($update) {
            return response()->json(['success' => true, 'message' => 'Tipe Berhasil Diupdate']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something when wrong!!']);
        }
    }

    public function destroy($id)
    {
        $tipe = Tipe::where('uuid', $id)->delete();
        if ($tipe) {
            return response()->json(['success' => true, 'message' => 'Tipe berhasil dihapus']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something whenwrong!!']);
        }
    }
}

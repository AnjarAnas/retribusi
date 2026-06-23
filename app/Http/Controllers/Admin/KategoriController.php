<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index(Request $req)
    {
        $data['kategori'] = Kategori::with('objek')->get(); // Example data
        $data['desa'] = Desa::get();

        return view('admin.kategori', $data);
    }

    public function store(Request $req)
    {
        $req->validate([
            'nama' => 'required|string',
            'alamat' => 'string|required',
        ]);
        $create = Kategori::create([
            'nama' => $req->input('nama'),
            'alamat' => $req->input('alamat'),
            'desa_id' => $req->input('desa_id'),
            'uuid' => Str::uuid(),
        ]);
        if ($create) {
            return response()->json(['success' => true, 'message' => 'Kategori Berhasil Ditambahkan']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something when wrong!!']);
        }
    }

    public function update(Request $req)
    {
        $req->validate([
            'id' => 'required',
            'nama' => 'required|string',
            'alamat' => 'string|required',
        ]);
        $update = Kategori::where('id', $req->input('id'))->update([
            'nama' => $req->input('nama'),
            'alamat' => $req->input('alamat'),

        ]);
        if ($update) {
            return response()->json(['success' => true, 'message' => 'Kategori Berhasil Diupdate']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something when wrong!!']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Objek;
use Illuminate\Http\Request;

class ObjekController extends Controller
{
    public function index(Request $req)
    {
        $data['objek'] = Objek::query()->with('kategori', 'tipe')->get();

        return view('admin.objek', $data);
    }
}

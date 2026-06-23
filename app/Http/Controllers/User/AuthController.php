<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'login gagal',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'login berhasil',
            'token' => $token,
            'user' => auth()->user(),
        ]);
    }
}

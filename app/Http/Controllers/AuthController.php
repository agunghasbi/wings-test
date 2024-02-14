<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('login');
    }

    public function authentication(Request $request)
    {
        $username = $request->input('User');
        $password = $request->input('Password');

        $dataAuth['User'] = $username;
        $dataAuth['password'] = $password;

        $authenticate = Auth::guard("web")->attempt($dataAuth);
        if (!$authenticate)
            return response()->json([
                'statusCode' => 404,
                'message' => 'Username atau Password salah, Mohon periksa kembali inputan anda!'
            ], 404);

        // Session
        Session::put('uid', Auth::id());

        return response()->json([
            'statusCode' => 200,
            'message' => 'Login berhasil',
        ]);
    }

    public function logout()
    {
        // Remove Session
        Session::flush();
        Auth::logout();

        return redirect()->to(route('login'));
    }
}

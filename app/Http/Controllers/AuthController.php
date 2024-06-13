<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index() {
        return view('login');
    }
    function authenticate(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // return 'ok';
            return response()->json([
                'success' => true,
                'message' => 'OK',
            ],200);
        }
        
        
        return response()->json([
            'success' => false,
            'message' => 'Login gagal',
        ],401);
        // return back()->withErrors([
        //     'error' => 'The provided credentials do not match our records.',
        // ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login_form()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'npk' => 'required|string',
            'password' => 'required|string',
        ]);
    }
    public function register_form()
    {
        return view('auth.register');
    }
}

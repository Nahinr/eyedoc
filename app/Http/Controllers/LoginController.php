<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|min:5',
            'password' => 'required|min:5',
        ]);
 
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Credenciales Invalidas']);
    }
}

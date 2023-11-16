<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
{
    return view('auth.register');
}

public function store(Request $request)
{
   

    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:20',
        'password' => 'required|min:6|confirmed',
        'role' => 'required|string|in:medico,secretaria',
    ]);


    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'password' => Hash::make($request->input('password')),
        'role' => $request->input('role'),
    ]);

 

   
    return redirect('/dashboard')->with('success', 'Paciente creado correctamente');
}
    
}

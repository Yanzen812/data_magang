<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function index()
    {
        // If user is already logged in, redirect based on role
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('absensi_siswa');
            }
        }
        
        return view("login");
    }

    function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard')->with('success', Auth::user()->username . ' Berhasil Login sebagai Admin');
            } else {
                return redirect()->route('absensi_siswa')->with('success', Auth::user()->username . ' Berhasil Login sebagai Siswa');
            }
        } else {
            return redirect()->route('login')
                ->withErrors('Username dan password yang dimasukkan tidak sesuai')
                ->withInput();
        }
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}


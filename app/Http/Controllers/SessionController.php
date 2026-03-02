<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\auth;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function index(){
        return view("login");
        }
    function login(Request $request){
            $request->validate([
                'nama'=>'required',
                'password'=>'required'
            ],[
                'nama.required' => 'Nama wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]);

        $infologin = [
            'nama' => $request->nama,
            'password' => $request->password
        ];

        // $rolecek = [
        //     'role' => $request->role('admin')
        // ];

        if(Auth::attempt($infologin)){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('dashboard')->with('success', Auth::user()->name.' Berhasil Login');
            }else{
                return redirect()->route('absensi')->with('success', Auth::user()->name.' Berhasil Login');
            }}else{
            return redirect()->route('login')->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
            // echo "1sukses";
            // exit();
        }

    }
}

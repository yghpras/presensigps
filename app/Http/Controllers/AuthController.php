<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function proseslogin(Request $request) 
    {
        // $pass =1234;
        // echo Hash::make($pass);
        if (Auth::guard('karyawan')->attempt(['nik' => $request->nik, 'password' => $request->password])){
            return redirect('/dashboard');
        }else{
            return redirect('/')->with(['warning'=> 'Nik/Password Salah']);
        }
    }

    public function proseslogout(){
        if(Auth::guard('karyawan')->check()){
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    public function proseslogoutadmin(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }

    public function prosesloginadmin(Request $request) 
    {
        // $pass =1234;
        // echo Hash::make($pass);
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/panel/dashboardadmin');
        }else{
            return redirect('/panel')->with(['warning'=> 'Username/Password Salah']);
        }
    }
}

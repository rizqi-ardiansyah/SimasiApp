<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
use App\Models\Karyawan;
use App\Models\Medis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login', [
            'title' => 'Silahkan login terlebih dahulu',
        ]);
    }

    public function showLoginForm() 
    { return view('login.login');} // buat file resources/views/auth/login.blade.php }}

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($user = \App\Models\User::where('email', $request->email)->first()) {
            if (Auth::guard('web')->attempt($credentials)) {
                session()->put('web_user_id', Auth::guard('web')->id());
                return redirect()->route('dashboard');
            }
        }

        if ($karyawan = \App\Models\Karyawan::where('email', $request->email)->first()) {
            if (Auth::guard('karyawan')->attempt($credentials)) {
                session()->put('karyawan_user_id', Auth::guard('karyawan')->id());
                return redirect()->route('dashboard');
            }
        }

        if ($medis = \App\Models\Medis::where('email', $request->email)->first()) {
            if (Auth::guard('medis')->attempt($credentials)) {
                session()->put('medis_user_id', Auth::guard('medis')->id());
                return redirect()->route('dashboard');
            }
        }

        if ($psikolog = \App\Models\Psikolog::where('email', $request->email)->first()) {
            if (Auth::guard('psikolog')->attempt($credentials)) {
                session()->put('psikolog_user_id', Auth::guard('psikolog')->id());
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);




        // $credentials = $request->only('email', 'password');

        // if ($user = \App\Models\User::where('email', $request->email)->first()) {
        //     if (Auth::guard('web')->attempt($credentials)) {
        //         session()->put('web_user_id', Auth::guard('web')->id());
        //     }
        // }

        // if ($karyawan = \App\Models\Karyawan::where('email', $request->email)->first()) {
        //     if (Auth::guard('karyawan')->attempt($credentials)) {
        //         session()->put('karyawan_user_id', Auth::guard('karyawan')->id());
        //     }
        // }

        // if ($admin = \App\Models\Admin::where('email', $request->email)->first()) {
        //     if (Auth::guard('admin')->attempt($credentials)) {
        //         session()->put('admin_user_id', Auth::guard('admin')->id());
        //     }
        // }

        // return redirect()->route('dashboard');






       
        // Cek apakah email ada di tabel admin

        // $pusdalop = User::where('email', $request->email)->first();
        // if ($pusdalop) {
        //     if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
        //         return redirect()->intended('dashboard');
        //     } else {
        //         return back()->withErrors(['email' => 'Password salah.']);
        //     }
        // }
        
        // $admin = Admin::where('email', $request->email)->first();
        // if ($admin) {
        //     if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
        //         return redirect()->intended('dashboard');
        //     } else {
        //         return back()->withErrors(['email' => 'Password salah.']);
        //     }
        // }

        // // Cek apakah email ada di tabel karyawan
        // $karyawan = Karyawan::where('email', $request->email)->first();
        // if ($karyawan) {
        //     if (Auth::guard('karyawan')->attempt($request->only('email', 'password'))) {
        //         return redirect()->intended('dashboard');
        //     } else {
        //         return back()->withErrors(['email' => 'Password salah.']);
        //     }
        // }

        // // Jika email tidak ditemukan di dua tabel
        // return back()->withErrors(['email' => 'Email tidak ditemukan.']);






        // $credentials = $request->validate([
        //     'email' => 'required|email:dns',
        //     'password' => 'required',
        // ]);

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('dashboard');
        // }

        // return back()->with('loginError', 'Cek email atau password!');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
    session()->forget('web_user_id');

    Auth::guard('karyawan')->logout();
    session()->forget('karyawan_user_id');

    Auth::guard('medis')->logout();
    session()->forget('medis_user_id');

    session()->invalidate();
    session()->regenerateToken();

    return redirect('/login');

        
    // Auth::guard('web')->logout();
    // Auth::guard('admin')->logout();
    // Auth::guard('karyawan')->logout();
    // request()->session()->invalidate();
    // request()->session()->regenerateToken();
    // return redirect()->route('login');


    // Auth::logout();
        // request()->session()->invalidate();
        // request()->session()->regenerateToken();
    }
}
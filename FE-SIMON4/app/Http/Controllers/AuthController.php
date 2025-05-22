<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Impor Facade DB
use App\Models\User; // Impor model User

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input dengan pesan kustom
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
        ]);

        // Ambil user berdasarkan username dari tabel 'users'
        // PERINGATAN: Pastikan nama tabel di DB Anda adalah 'users' (jamak)
        // dan kolom ID adalah 'id' (default Laravel)
        $user = DB::table('user')->where('username', $request->username)->first();

        // Verifikasi kecocokan password secara plain text
        // PERINGATAN KERAS: Membandingkan password plain text SANGAT TIDAK AMAN!
        if ($user && $user->password === $request->password) {
            // Lakukan login menggunakan ID user
            Auth::loginUsingId($user->id_user); // Asumsi kolom ID user adalah 'id'

            // Redirect ke satu dashboard
            return redirect()->route('dashboard')->with('success', 'Anda berhasil login!');
        } else {
            // Jika user tidak ditemukan atau password tidak cocok
            return redirect()->back()->withErrors(['username' => 'Username atau password salah.'])->onlyInput('username');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        // $request->session()->regenerateToken(); DIHAPUS SESUAI PERMINTAAN. SANGAT TIDAK AMAN!

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
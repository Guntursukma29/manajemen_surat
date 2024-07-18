<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prodi;
use App\Models\Surat;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $title = "Dashboard";
    $userId = Auth::user()->id;
    $role = Auth::user()->role_id;

    $totalSuratMasuk = 0;
    $totalSuratKeluar = 0;
    $totalJenisSurat = 0;
    $totalProdi = 0;
    $totalUser = 0;

    if ($role == 1) {
        // Jika role adalah pengirim
        $totalSuratMasuk = Surat::where('penerima_id', $userId)->count();
        $totalSuratKeluar = Surat::where('pengirim_id', $userId)->whereStatus('diterima')->count();
        $totalSurat = Surat::where('pengirim_id', $userId)->whereStatus('pending')->count(); 
        $totalJenisSurat = JenisSurat::count();
        $totalProdi = Prodi::count();
        $totalUser = User::count();
    } elseif ($role == 2) {
        // Jika role adalah penerima
        $totalSuratMasuk = Surat::where('penerima_id', $userId)->count(); // Ubah query untuk mencocokkan penerima_id dengan userId
        $totalSuratKeluar = Surat::where('pengirim_id', $userId)->whereStatus('diterima')->count();
        $totalSurat = Surat::where('pengirim_id', $userId)->whereStatus('pending')->count();
    }

    return view('dashboard', compact('totalSuratMasuk', 'totalSuratKeluar', 'role','totalSurat', 'totalJenisSurat', 'totalProdi', 'totalUser' , 'title'));
}

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Jika autentikasi berhasil
        return redirect()->intended('/dashboard'); // Ganti '/dashboard' dengan rute yang ingin Anda arahkan setelah login
    }

    // Jika autentikasi gagal
    return redirect()->route('login')->with('error', 'Email atau password salah');
}

}

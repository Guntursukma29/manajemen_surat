<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;

class SuratController extends Controller
{
    // public function showSuratMasuk($id)
    // {
    //     $surat = Surat::find($id);

    //     if (!$surat) {
    //         return redirect()->back()->with('error', 'Surat tidak ditemukan.');
    //     }

    //     // Example usage of $surat attributes
    //     $suratTanggal = $surat->tanggal;

    //     return view('suratmasuk', compact('surat'));
    // }

    // public function showSuratDiterima($id)
    // {
    //     $surat = Surat::find($id);

    //     if (!$surat) {
    //         return redirect()->back()->with('error', 'Surat tidak ditemukan.');
    //     }

    //     // Example usage of $surat attributes
    //     $suratTanggal = $surat->tanggal;

    //     return view('suratditerima', compact('surat'));
    // }
}

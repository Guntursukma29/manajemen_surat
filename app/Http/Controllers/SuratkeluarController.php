<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class SuratkeluarController extends Controller
{
    public function index()
    {
        $title = "Surat Keluar";
        $surat = Surat::where('pengirim_id', auth()->user()->id)
                      ->where('status', 'diterima')
                      ->get();
        

        return view('suratkeluar', compact('surat','title'));
    }
}

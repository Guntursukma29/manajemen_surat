<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\JenisSurat;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $title = "Rekap Surat";
        $jenisSurat = JenisSurat::all();

        $suratMasukQuery = Surat::where('penerima_id', Auth::user()->id);
        $suratKeluarQuery = Surat::where('pengirim_id', auth()->user()->id)
            ->where('status', 'diterima');

        if ($request->filled('tanggal')) {
            $suratMasukQuery->whereDate('tanggal', $request->tanggal);
            $suratKeluarQuery->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            $suratMasukQuery->whereMonth('tanggal', date('m', strtotime($request->bulan)))
                            ->whereYear('tanggal', date('Y', strtotime($request->bulan)));
            $suratKeluarQuery->whereMonth('tanggal', date('m', strtotime($request->bulan)))
                             ->whereYear('tanggal', date('Y', strtotime($request->bulan)));
        }

        if ($request->filled('jenis_surat_id')) {
            $suratMasukQuery->where('jenis_surat_id', $request->jenis_surat_id);
            $suratKeluarQuery->where('jenis_surat_id', $request->jenis_surat_id);
        }

        $suratMasuk = $suratMasukQuery->get();
        $suratKeluar = $suratKeluarQuery->get();

        return view('rekap', compact('jenisSurat', 'suratMasuk', 'suratKeluar', 'title'));
    }

    public function cetakSuratMasuk(Request $request)
    {
        $suratMasukQuery = Surat::where('penerima_id', Auth::user()->id);

        if ($request->filled('tanggal')) {
            $suratMasukQuery->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            $suratMasukQuery->whereMonth('tanggal', date('m', strtotime($request->bulan)))
                            ->whereYear('tanggal', date('Y', strtotime($request->bulan)));
        }

        if ($request->filled('jenis_surat_id')) {
            $suratMasukQuery->where('jenis_surat_id', $request->jenis_surat_id);
        }

        $suratMasuk = $suratMasukQuery->get();

        $pdf = Pdf::loadView('pdf.surat_masuk', compact('suratMasuk'));
        return $pdf->download('rekap_surat_masuk.pdf');
    }

    public function cetakSuratKeluar(Request $request)
    {
        $suratKeluarQuery = Surat::where('pengirim_id', auth()->user()->id)
            ->where('status', 'diterima');

        if ($request->filled('tanggal')) {
            $suratKeluarQuery->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            $suratKeluarQuery->whereMonth('tanggal', date('m', strtotime($request->bulan)))
                             ->whereYear('tanggal', date('Y', strtotime($request->bulan)));
        }

        if ($request->filled('jenis_surat_id')) {
            $suratKeluarQuery->where('jenis_surat_id', $request->jenis_surat_id);
        }

        $suratKeluar = $suratKeluarQuery->get();

        $pdf = Pdf::loadView('pdf.surat_keluar', compact('suratKeluar'));
        return $pdf->download('rekap_surat_keluar.pdf');
    }
}

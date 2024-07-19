<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RequestSurat;
use Illuminate\Http\Request;
use App\Models\JenisSuratMahasiswa;
use Illuminate\Support\Facades\Auth;

class SuratMahasiswaController extends Controller
{
    public function index()
    {
        $title = "Selamat Datang";
        $user = Auth::user();
        $prodiId = $user->prodi_id;

        $jenisSurat = JenisSuratMahasiswa::all();
        $requestSurat = RequestSurat::where('prodi_id', $prodiId)
        ->whereNull('surat_dikirim')
        ->get();
        return view('mahasiswa.index', compact('requestSurat', 'jenisSurat', 'title'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(RequestSurat $requestSurat)
    {
        return view('request_surat.show', compact('requestSurat'));
    }

    public function edit(RequestSurat $requestSurat)
    {
        $jenisSurat = JenisSuratMahasiswa::all();
        $users = User::all();
        return view('surat_mahasiswa.edit', compact('requestSurat', 'jenisSurat', 'users'));
    }

    public function update(Request $request, RequestSurat $requestSurat)
    {
        $request->validate([
            'email' => 'required|email',
            'nim' => 'required',
            'nama' => 'required',
            'angkatan' => 'required|integer',
            'prodi' => 'required',
            'keperluan' => 'required',
        ]);

        $requestSurat->update($request->all());

        return redirect()->route('surat_mahasiswa.index')
                         ->with('success', 'Request Surat updated successfully.');
    }

    public function destroy(RequestSurat $requestSurat)
    {
        $requestSurat->delete();

        return redirect()->route('surat_mahasiswa.index')
                         ->with('success', 'Request Surat deleted successfully.');
    }

    public function rekap(Request $request)
    {
        $title = "Rekap Surat Mahasiswa";
        $user = Auth::user();
        $prodiId = $user->prodi_id;
        $jenisSurat = JenisSuratMahasiswa::all();

        $query = RequestSurat::where('prodi_id', $prodiId)
                             ->whereNotNull('surat_dikirim');

        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        if ($request->filled('tanggal_start') && $request->filled('tanggal_end')) {
            $query->whereBetween('created_at', [$request->tanggal_start, $request->tanggal_end]);
        }

        if ($request->filled('keperluan_id')) {
            $query->where('jenis_surat_id', $request->keperluan_id);
        }

        $requestSurat = $query->get();

        return view('mahasiswa.rekap', compact('requestSurat', 'title', 'jenisSurat'));
    }
}

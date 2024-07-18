<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RequestSurat;
use Illuminate\Http\Request;
use App\Models\JenisSuratMahasiswa;
use Illuminate\Support\Facades\Auth;

class SuratMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $title = "Selamat Datang";
    $user = Auth::user(); // Get the authenticated user
    $prodiId = $user->prodi_id; // Get the prodi_id of the authenticated user

    $jenisSurat = JenisSuratMahasiswa::all();
    $requestSurat = RequestSurat::where('prodi_id', $prodiId)->get(); // Filter request surat by prodi_id

    // Debugging the retrieved data
    // dd($prodiId, $requestSurat);

    return view('mahasiswa.index', compact('requestSurat', 'jenisSurat', 'title'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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
    public function rekap()
{
    $title = "Rekap Surat Mahasiswa";
    $user = Auth::user(); // Get the authenticated user
    $prodiId = $user->prodi_id; // Get the prodi_id of the authenticated user
    $jenisSurat = JenisSuratMahasiswa::all();

    // Fetch request surat data where surat has been sent
    $requestSurat = RequestSurat::where('prodi_id', $prodiId)
                                ->whereNotNull('surat_dikirim') // Assuming 'surat_dikirim' column indicates the surat has been sent
                                ->get();

    return view('mahasiswa.rekap', compact('requestSurat', 'title'));
}

}

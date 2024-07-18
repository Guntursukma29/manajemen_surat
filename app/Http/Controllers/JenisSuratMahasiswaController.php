<?php

namespace App\Http\Controllers;

use App\Models\JenisSuratMahasiswa;
use Illuminate\Http\Request;

class JenisSuratMahasiswaController extends Controller
{
    public function index()
    {
        $title = 'Jenis Surat Mahasiswa';
        $jenisSuratMahasiswa = JenisSuratMahasiswa::all();
        return view('jenis_surat.index', compact('jenisSuratMahasiswa', 'title'));
    }

    public function create()
    {
        return view('jenis_surat_mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        JenisSuratMahasiswa::create($request->all());

        return redirect()->route('jenis_surat_mahasiswa.index')
                         ->with('success', 'Jenis Surat Mahasiswa created successfully.');
    }

    public function show(JenisSuratMahasiswa $jenisSuratMahasiswa)
    {
        return view('jenis_surat_mahasiswa.show', compact('jenisSuratMahasiswa'));
    }

    public function edit(JenisSuratMahasiswa $jenisSuratMahasiswa)
    {
        return view('jenis_surat_mahasiswa.edit', compact('jenisSuratMahasiswa'));
    }

    public function update(Request $request, JenisSuratMahasiswa $jenisSuratMahasiswa)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $jenisSuratMahasiswa->update($request->all());

        return redirect()->route('jenis_surat_mahasiswa.index')
                         ->with('success', 'Jenis Surat Mahasiswa updated successfully.');
    }

    public function destroy(JenisSuratMahasiswa $jenisSuratMahasiswa)
    {
        $jenisSuratMahasiswa->delete();

        return redirect()->route('jenis_surat_mahasiswa.index')
                         ->with('success', 'Jenis Surat Mahasiswa deleted successfully.');
    }
}

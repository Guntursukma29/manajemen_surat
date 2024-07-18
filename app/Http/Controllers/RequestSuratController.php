<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RequestSurat;
use Illuminate\Http\Request;
use App\Models\JenisSuratMahasiswa;
use Illuminate\Support\Facades\Auth;

class RequestSuratController extends Controller
{
    public function index()
    {
        $title = "Selamat Datang";
    
        $jenisSurat = JenisSuratMahasiswa::get();
        $requestSurat = RequestSurat::get();
        $users = User::all(); // Fetch all users or based on your logic
    
        return view('layouts.request', compact('requestSurat', 'jenisSurat', 'title', 'users'));
    }


    public function create()
    {
        $jenisSurat = JenisSuratMahasiswa::all();
        $users = User::all();
        return view('layouts.request', compact('jenisSurat', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nim' => 'required',
            'nama' => 'required',
            'angkatan' => 'required|integer',
            'prodi_id' => 'required',
            'keperluan_id' => 'required',
            'no_telp' => 'required',
        ]);
        
        RequestSurat::create($request->all());

        return redirect()->route('request_surat.index')
                         ->with('success', 'Request Surat created successfully.');
    }

    public function show(RequestSurat $requestSurat)
    {
        return view('request_surat.show', compact('requestSurat'));
    }

    public function edit(RequestSurat $requestSurat)
    {
        $jenisSurat = JenisSuratMahasiswa::all();
        $users = User::all();
        return view('request_surat.edit', compact('requestSurat', 'jenisSurat', 'users'));
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

        return redirect()->route('request_surat.index')
                         ->with('success', 'Request Surat updated successfully.');
    }

    public function destroy(RequestSurat $requestSurat)
    {
        $requestSurat->delete();

        return redirect()->route('request_surat.index')
                         ->with('success', 'Request Surat deleted successfully.');
    }
}

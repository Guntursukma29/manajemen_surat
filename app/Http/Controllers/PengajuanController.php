<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Surat;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SuratMasukNotification;
use App\Notifications\SuratDiterimaNotification;

class PengajuanController extends Controller
{
    public function index()
    {
        $title = "Kirim Surat";
        $surat = Surat::where('pengirim_id', auth()->user()->id)->whereStatus('pending')->get();
        return view('pengajuan.index', compact('surat', 'title'));
    }

    public function create()
    {
        $title = "Form Pengiriman";
        $jenisSurat = JenisSurat::all();
        $users = User::where('role_id', 2)->get();
        return view('pengajuan.create', compact('jenisSurat', 'users', 'title'));
    }

    

    public function store(Request $request)
{
    $rules = [
        'nama_surat' => 'required|string|max:255',
        'perihal' => 'required|string|max:255',
        'jenis_surat_id' => 'required|exists:jenis_surat,id',
        'nomor_surat' => 'required|string|unique:surat,nomor_surat|max:255',
    ];

    if (Auth::user()->role_id != 1) { // Non-admin users must include a file
        $rules['filesurat'] = 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048';
    }

    $request->validate($rules);

    $surat = new Surat();
    $surat->pengirim_id = auth()->user()->id;

    if (Auth::user()->role_id == 1) { 
        $surat->penerima_id = $request->penerima_id;
        $surat->asal_surat = $request->asal_surat; 
    } else { 
        $surat->penerima_id = 1; 
        $surat->tujuan = $request->tujuan; 
    }

    $surat->tanggal = now();
    $surat->nama = auth()->user()->name;
    $surat->nama_surat = $request->nama_surat;
    $surat->perihal = $request->perihal;
    $surat->jenis_surat_id = $request->jenis_surat_id;
    $surat->nomor_surat = $request->nomor_surat;
    $surat->status = 'pending';

    if (Auth::user()->role_id != 1 && $request->hasFile('filesurat')) { // Only handle file for non-admin users
        $file = $request->file('filesurat');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/surat', $filename);
        $surat->filesurat = $filename;
    } else {
        $surat->filesurat = ''; // Set a default value or allow it to be nullable
    }

    $surat->save();

    // Kirim notifikasi ke penerima surat
    $penerima = User::find($surat->penerima_id);
    if ($penerima) {
        $penerima->notify(new SuratMasukNotification($surat));
    }

    return redirect()->route('pengajuansurat.index')->with('success', 'Surat berhasil diajukan');
}


    public function updateStatus(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        if ($surat->penerima_id != Auth::user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengubah status surat ini.');
        }

        $surat->status = 'diterima';
        $surat->save();

        // Tandai notifikasi sebagai telah dibaca
        $user = Auth::user();
        $user->unreadNotifications->where('data.surat_id', $surat->id)->markAsRead();

        // Kirim notifikasi surat diterima ke pengirim
        $pengirim = User::find($surat->pengirim_id);
        if ($pengirim) {
            $pengirim->notify(new SuratDiterimaNotification($surat));
        }

        return redirect()->back()->with('success', 'Status surat berhasil diubah menjadi diterima.');
    }

    public function edit($id)
    {
        $title = "Edit";
        $surat = Surat::findOrFail($id);
        $jenisSurat = JenisSurat::all();
        $users = User::where('role_id', 2)->get();
        return view('pengajuan.edit', compact('surat', 'jenisSurat', 'users', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_surat' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'filesurat' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'nomor_surat' => 'required|string|unique:surat,nomor_surat,' . $id . '|max:255',
        ]);

        $surat = Surat::findOrFail($id);
        $surat->nama_surat = $request->nama_surat;
        $surat->perihal = $request->perihal;
        $surat->jenis_surat_id = $request->jenis_surat_id;
        $surat->nomor_surat = $request->nomor_surat;

        if ($request->hasFile('filesurat')) {
            Storage::delete('public/surat/' . $surat->filesurat);
            $file = $request->file('filesurat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/surat', $filename);
            $surat->filesurat = $filename;
        }

        if (Auth::user()->role_id == 1) { // Jika admin
            $surat->asal_surat = $request->asal_surat; // Update asal surat
        } else { // Jika user biasa
            $surat->tujuan = $request->tujuan; // Update tujuan surat
        }

        $surat->save();

        return redirect()->route('pengajuansurat.index')->with('success', 'Surat berhasil diperbarui');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id); 
        Storage::delete('public/surat/' . $surat->filesurat);
        $surat->delete();
        return redirect()->route('pengajuansurat.index')->with('success', 'Surat berhasil dihapus');
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }
}

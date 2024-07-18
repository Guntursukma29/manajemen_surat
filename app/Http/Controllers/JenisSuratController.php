<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisSurat;

class JenisSuratController extends Controller
{
    public function index()
    {
        $title = "Jenis Surat";
        $jenissurat = JenisSurat::all();
        return view('jenissurat', compact('jenissurat' , 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|string|max:255',
        ]);

        JenisSurat::create($request->all());
        return redirect()->route('jenissurat.index')->with('success', 'Surat created successfully');
    }

    public function edit($id)
    {
        $jenissurat = JenisSurat::findOrFail($id);
        return view('edit_surat', compact('jenissurat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_surat' => 'required|string|max:255',
        ]);

        $jenissurat = JenisSurat::findOrFail($id);
        $jenissurat->update($request->all());
        return redirect()->route('jenissurat.index')->with('success', 'Surat updated successfully');
    }

    public function destroy($id)
{
    $jenissurat = JenisSurat::findOrFail($id);

    // Cek apakah JenisSurat memiliki surat terkait
    if ($jenissurat->surat()->count() > 0) {
        // Jika ada surat terkait, kembalikan dengan pesan error
        return redirect()->route('jenissurat.index')->with('error', 'Jenis surat cannot be deleted because it has related data.');
    }

    // Jika tidak ada surat terkait, hapus JenisSurat
    $jenissurat->delete();

    return redirect()->route('jenissurat.index')->with('success', 'Jenis surat deleted successfully');
}

}

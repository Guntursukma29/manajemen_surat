<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $title = "Prodi";
        $prodi = Prodi::all();
        return view('prodi', compact('prodi' , 'title'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_prodi' => 'required|string|max:255',
    ]);

    try {
        Prodi::create($request->all());
        return redirect()->route('prodi.index')->with('success', 'Prodi created successfully');
    } catch (\Exception $e) {
        return redirect()->route('prodi.index')->with('error', 'Failed to create Prodi');
    }
}

    
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        return view('edit_prodi', compact('prodi'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_prodi' => 'required|string|max:255',
    ]);

    try {
        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->all());
        return redirect()->route('prodi.index')->with('success', 'Prodi updated successfully');
    } catch (\Exception $e) {
        return redirect()->route('prodi.index')->with('error', 'Failed to update Prodi');
    }
}

    
public function destroy($id)
{
    $prodi = Prodi::findOrFail($id);

    if ($prodi->users()->count() > 0) {
        return redirect()->route('prodi.index')->with('error', 'Prodi cannot be deleted because it has related data.');
    }

    $prodi->delete();
    return redirect()->route('prodi.index')->with('success', 'Prodi deleted successfully');
}

}

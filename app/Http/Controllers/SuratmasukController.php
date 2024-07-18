<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use App\Notifications\SuratForwarded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratmasukController extends Controller
{
    public function index()
    {
        $title = "Surat Masuk";
        $surat = Surat::where('penerima_id', Auth::user()->id)
        
        ->get();        
        $users = User::all(); // Fetch all users for forwarding options

        return view('suratmasuk', compact('surat', 'title', 'users'));
    }

    public function forward(Request $request, $id)
{
    $request->validate([
        'forward_to' => 'required|array',
        'forward_to.*' => 'exists:users,id',
    ]);

    $surat = Surat::findOrFail($id);
    $forwarded_to = $request->forward_to;

    // Update status and forward information
    $surat->update([
        'forwarded_to' => $forwarded_to,
        'status' => 'Diposisi', // Update status to 'Diposisi'
    ]);

    // Notify users who received the forwarded surat (optional)
    $users = User::whereIn('id', $forwarded_to)->get();
    foreach ($users as $user) {
        $user->notify(new SuratForwarded($surat));
    }

    return redirect()->route('suratmasuk')->with('success', 'Surat berhasil diteruskan');
}

}

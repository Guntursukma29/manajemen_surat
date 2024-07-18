<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;

class NotificationController extends Controller
{
    public function readNotification($id)
    {
        $notification = Auth::user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();

            $suratId = $notification->data['surat_id'];
            $surat = Surat::find($suratId);

            if (!$surat) {
                return redirect()->back()->with('error', 'Surat tidak ditemukan.');
            }

            if ($notification->data['message'] === 'Surat Anda "' . $surat->nama_surat . '" telah diterima.') {
                return redirect()->route('suratkeluar', $suratId); // Sesuaikan dengan rute untuk surat diterima
            } else {
                return redirect()->route('suratmasuk', $suratId); // Sesuaikan dengan rute untuk surat masuk
            }
        }

        return redirect()->back()->with('error', 'Notifikasi tidak ditemukan.');
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }
}

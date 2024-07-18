<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\User;

class SuratMasukNotification extends Notification
{
    use Queueable;

    protected $surat;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($surat)
    {
        $this->surat = $surat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $pengirim = User::find($this->surat->pengirim_id);
        $nama_pengirim = $pengirim ? $pengirim->name : 'Tidak diketahui';

        return [
            'surat_id' => $this->surat->id,
            'pengirim_id' => $this->surat->pengirim_id,
            'nama_pengirim' => $nama_pengirim,
            'nama_surat' => $this->surat->nama_surat,
            'message' => 'Anda memiliki surat masuk "' . $this->surat->nama_surat . '" dari ' . $nama_pengirim,
        ];
    }
}

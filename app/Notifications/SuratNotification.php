<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class SuratMasukNotification extends Notification
{
    use Queueable;

    protected $surat;

    public function __construct($surat)
    {
        $this->surat = $surat;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'surat_id' => $this->surat->id,
            'nama_surat' => $this->surat->nama_surat,
            'pengirim' => $this->surat->pengirim->name,
            'message' => 'Anda menerima surat baru dari ' . $this->surat->pengirim->name,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'surat_id' => $this->surat->id,
            'nama_surat' => $this->surat->nama_surat,
            'pengirim' => $this->surat->pengirim->name,
            'message' => 'Anda menerima surat baru dari ' . $this->surat->pengirim->name,
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

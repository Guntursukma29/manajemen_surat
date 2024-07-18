<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SuratDiterimaNotification extends Notification
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
        return [
            'surat_id' => $this->surat->id,
            'message' => 'Surat Anda "' . $this->surat->nama_surat . '" telah diterima.',
        ];
    }
}

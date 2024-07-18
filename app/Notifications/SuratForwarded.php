<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SuratForwarded extends Notification
{
    use Queueable;

    protected $surat;

    public function __construct($surat)
    {
        $this->surat = $surat;
    }

    public function via($notifiable)
    {
        // Remove 'mail' from here to prevent sending email notifications
        return [];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Anda telah menerima surat yang diteruskan.')
                    ->action('Lihat Surat', url('/suratmasuk/' . $this->surat->id))
                    ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    public function toArray($notifiable)
    {
        return [
            'surat_id' => $this->surat->id,
            'nama_surat' => $this->surat->nama_surat,
        ];
    }
}

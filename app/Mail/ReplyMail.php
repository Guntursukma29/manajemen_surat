<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $replyContent;
    public $filePath;

    public function __construct($replyContent, $fileName = null)
    {
        $this->replyContent = $replyContent;
        $this->filePath = $fileName ? 'public/reply_files/' . $fileName : null;
    }

    public function build()
    {
        $email = $this->view('emails.reply')
                      ->with(['replyContent' => $this->replyContent]);

                      if ($this->filePath && file_exists(public_path($this->filePath))) {
                        $email->attach(public_path($this->filePath));
                    }

        return $email;
    }
}

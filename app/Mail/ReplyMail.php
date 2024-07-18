<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $replyContent;
    public $fileName;

    public function __construct($replyContent, $fileName = null)
    {
        $this->replyContent = $replyContent;
        $this->fileName = $fileName;
    }

    public function build()
    {
        $email = $this->view('emails.reply')
                      ->with(['replyContent' => $this->replyContent]);

        if ($this->fileName) {
            $email->attach(storage_path('app/reply_files/' . $this->fileName));
        }

        return $email;
    }
}

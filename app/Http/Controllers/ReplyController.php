<?php
namespace App\Http\Controllers;

use App\Mail\ReplyMail;
use App\Models\RequestSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reply_content' => 'required',
            'reply_file' => 'nullable|file|max:10240', // max 10MB
        ]);
    
        $requestSurat = RequestSurat::find($request->surat_id);
        $toEmail = $requestSurat->email;
        $replyContent = $request->reply_content;
    
        if ($request->hasFile('reply_file')) {
            $file = $request->file('reply_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('public/reply_files'), $fileName);
            $requestSurat->surat_dikirim = $fileName;
        }
        
    
        try {
            $userName = Auth::user()->name;
            $email = new ReplyMail($replyContent, $fileName);
            $email->from('your_email@gmail.com', $userName);
            
            Mail::to($toEmail)->send($email);

            $requestSurat->save();
        
            return redirect()->route('surat_mahasiswa.index')
                ->with('success', 'Reply sent successfully to ' . $toEmail);
        } catch (\Exception $e) {
            return redirect()->route('surat_mahasiswa.index')
                ->with('error', 'Email sending failed: ' . $e->getMessage());
        }
         
        
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\SuratNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';
    protected $fillable = [
        'penerima_id',
        'pengirim_id',
        'tanggal',
        'perihal',
        'nama_surat',
        'jenis_surat_id',
        'filesurat',
        'status',
        'bentuk_surat', 
        'tujuan', 
        'asal_surat',
        'forwarded_to'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }
    public function kirimNotifikasiSuratMasuk()
    {
        // Gantikan 'user' dengan objek pengguna yang ingin diberi notifikasi
        $this->penerima->notify(new SuratNotification($this, 'inbox'));
    }

    // Fungsi untuk mengirim notifikasi surat keluar
    public function kirimNotifikasiSuratKeluar()
    {
        // Gantikan 'user' dengan objek pengguna yang ingin diberi notifikasi
        $this->pengirim->notify(new SuratNotification($this, 'outbox'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestSurat extends Model
{
    use HasFactory;

    protected $table = 'request_surat';

    protected $fillable = [
        'email',
        'nim',
        'nama',
        'angkatan',
        'prodi_id',
        'keperluan_id',
        'judul_skripsi',
        'data_yang_dibutuhkan',
        'jumlah_data',
        'cara_pengambilan_data',
        'waktu_penelitian',
        'dosen_pembimbing',
        'no_telp',
        'nama_instansi',
        'nama_pimpinan',
        'alamat_instansi',
        'surat_dikirim'
    ];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSuratMahasiswa::class, 'keperluan_id');
    }

    public function prodi()
    {
        return $this->belongsTo(User::class, 'prodi_id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'id');
}
}

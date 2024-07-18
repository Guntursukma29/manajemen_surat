<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSuratMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'jenis_surat_mahasiswa';

    protected $fillable = [
        'name',
    ];
}

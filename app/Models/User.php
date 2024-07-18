<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'prodi_id',
        'nip',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function suratsDikirim()
    {
        return $this->hasMany(Surat::class, 'pengirim_id');
    }

    public function suratsDiterima()
    {
        return $this->hasMany(Surat::class, 'penerima_id');
    }

    public function isAdmin()
    {
        return $this->role_id === 1; 
    }
}

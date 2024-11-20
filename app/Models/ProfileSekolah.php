<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSekolah extends Model
{
    use HasFactory;

    protected $table = 'profile_sekolah';

    protected $fillable = [
        'judul',
        'isi',
    ];

    // Jika ingin menambahkan relasi, tambahkan di sini
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    // Nama tabel sesuai dengan tabel di database
    protected $table = 'galery';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'post_id',
        'judul',
        'deskripsi'
    ];

    // Relasi ke Photo
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    // Relasi balik ke Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

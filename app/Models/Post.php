<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $table = 'posts';

    protected $fillable = [
        'image',
        'judul',
        'isi',
        'category_id',
        'user_id',
        'status',
        'tanggal_posts',
        'lokasi',
    ];

    // Relasi ke tabel kategori (many to one)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi ke tabel user (many to one)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke galeries jika satu post bisa memiliki banyak galeri
    public function galeries()
    {
        return $this->hasMany(Galery::class, 'post_id');
    }
}

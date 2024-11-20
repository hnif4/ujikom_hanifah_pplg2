<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public $timestamps = false;  // Nonaktifkan timestamps
    protected $table = 'categories'; // Harus sama dengan nama tabel di migrasi

    protected $fillable = [
        'id',
        'nama',
        'deskripsi',      
    ];

   // Relasi ke posts
   public function posts()
   {
       return $this->hasMany(Post::class, 'category_id', 'id');
   }

    
}

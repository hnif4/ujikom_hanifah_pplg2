<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'photo';

    protected $fillable = ['judul_foto', 'isi_foto', 'user_id', 'galery_id'];

    // Model Photo
    public function galery()
    {
        return $this->belongsTo(Galery::class, 'galery_id');
    }
}

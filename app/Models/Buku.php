<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

        protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tgl_terbit',
        'harga',
        'photo',
    ];

    // inisiasi tabel mana yang dipakai
    protected $table = 'books';

    protected $dates = ['tgl_terbit'];
}

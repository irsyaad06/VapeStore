<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquid extends Model
{
    use HasFactory;
    
    protected $table = 'liquid';
    protected $fillable = [
        'gambar',
        'nama',
        'harga',
        'stok',
        'tipe',
        'ukuran',
    ];
}

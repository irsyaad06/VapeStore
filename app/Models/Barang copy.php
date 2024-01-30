<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'liquids';
    protected $fillable = [
        'gambar',
        'nama',
        'harga',
        'stok',
        'tipe',
    ];
}

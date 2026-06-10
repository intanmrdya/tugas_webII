<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', // TAMBAHKAN INI
        'kode_barang',
        'nama_barang',
        'satuan',
        'harga',
    ];

    // TAMBAHKAN FUNGSI RELASI INI
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
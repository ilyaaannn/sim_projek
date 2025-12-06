<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_barang';
    protected $primaryKey = 'id_barang';
    
    protected $fillable = [
        'nama_b',
        'desc_b',
        'id_kategori',
        'stok_b',
        'price',
        'image_path',
        'status'
    ];
}
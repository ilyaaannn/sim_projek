<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBarang extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_transaksi_barang';
    protected $primaryKey = 'id_transb';
    
    protected $fillable = [
        'id_barang',
        'tipe',
        'kuantiti',
        'stok_sebelum',
        'stok_sesudah',
        'desc_tb',
        'user_id'
    ];
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_user';
    
    // PENTING: Custom primary key
    protected $primaryKey = 'id_user';
    
    // Tambahkan ini jika auto increment
    public $incrementing = true;
    
    // Tipe primary key
    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'level',
        'alamat',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    // Tambahkan accessor untuk id agar Auth::id() bekerja
    public function getAuthIdentifier()
    {
        return $this->id_user;
    }
}
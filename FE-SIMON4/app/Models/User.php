<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; // Pastikan sesuai nama tabel di DB

    protected $fillable = [
        'username', 
        'password', 
    ];

    protected $hidden = [
        'password',
    ];

    // HAPUS atau KOMENTARI mutator ini!!
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }
}

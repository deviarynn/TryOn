<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas'; // Pastikan ini nama tabel kelas Anda
    protected $primaryKey = 'kode_kelas'; // Atau 'kode_kelas' jika itu primary key Anda
    public $incrementing = false; // Set false jika primaryKey non-incrementing
    protected $keyType = 'string'; // Atau 'string' jika kode_kelas string

    protected $fillable = [
        // Daftar kolom yang bisa diisi secara massal
        'kode_kelas',
        'nama_kelas',
    ];
}
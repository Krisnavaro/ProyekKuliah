<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users'; // Nama tabel pengguna di database Anda
    protected $primaryKey       = 'id';    // Nama primary key di tabel users

    protected $useAutoIncrement = true;

    // Definisikan field mana saja yang boleh diisi atau diubah oleh model ini
    protected $allowedFields    = [
        'nama_lengkap',
        'username',
        'email',
        'password',
        'role',
        'foto_profil'
    ];

    // Kita nonaktifkan fitur timestamp otomatis karena kolomnya tidak ada di database Anda
    protected $useTimestamps = false;
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    // Definisikan field mana saja yang boleh diisi atau diubah
    // =============================================================
    // TAMBAHKAN 'no_telpon' dan 'alamat_rumah' DI SINI
    // =============================================================
    protected $allowedFields    = [
        'nama_lengkap',
        'username',
        'email',
        'password',
        'role',
        'foto_profil',
        'no_telpon',      // <-- Tambahkan ini
        'alamat_rumah'    // <-- Tambahkan ini
    ];

    // Kita nonaktifkan fitur timestamp otomatis
    protected $useTimestamps = false;
}
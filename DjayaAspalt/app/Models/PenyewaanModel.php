<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyewaanModel extends Model
{
    protected $table            = 'penyewaan';
    protected $primaryKey       = 'id_sewa';
    protected $allowedFields    = [
        'id_sewa', 'id_alat', 'id_namasewa', 'harga_alatdisewa',
        'tanggal_penyewaan', 'alamat_penyewa'
    ];

    /**
     * Mengambil semua data penyewaan dengan menggabungkan data alat dan pelanggan.
     */
    public function getPenyewaanWithDetails()
    {
        return $this->select('penyewaan.*, alat.nama_alat, pelanggan.nama_lengkap')
                    ->join('alat', 'alat.id_alat = penyewaan.id_alat', 'left')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = penyewaan.id_namasewa', 'left')
                    ->findAll();
    }
}
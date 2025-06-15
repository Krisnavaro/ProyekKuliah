<?php

namespace App\Models;

use CodeIgniter\Model;

class PelaksanaanModel extends Model
{
    protected $table            = 'pelaksanaan';
    protected $primaryKey       = 'id_pelaksanaan';
    protected $allowedFields    = [
        'id_pelaksanaan', 'id_pelanggan', 'tanggal_pelaksanaan', 
        'alamat_pelaksanaan', 'waktu_pengerjaan'
    ];

    /**
     * Mengambil semua data pelaksanaan dengan menggabungkan data pelanggan.
     */
    public function getPelaksanaanWithPelanggan()
    {
        return $this->select('pelaksanaan.*, pelanggan.nama_lengkap')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = pelaksanaan.id_pelanggan', 'left')
                    ->findAll();
    }
}
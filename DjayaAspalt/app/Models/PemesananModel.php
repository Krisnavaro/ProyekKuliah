<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table            = 'pemesanan';
    protected $primaryKey       = 'id_pesanan';
    protected $allowedFields    = [
        'id_pesanan', 'id_pelaksanaan', 'nama_paketdipesan',
        'harga_paketdipesan', 'tanggal_pemesanan'
    ];

    /**
     * Mengambil semua data pemesanan dengan menggabungkan data pelanggan.
     * pemesanan -> pelaksanaan -> pelanggan
     */
    public function getPemesananWithDetails()
    {
        return $this->select('pemesanan.*, pelanggan.nama_lengkap, pelaksanaan.alamat_pelaksanaan')
                    ->join('pelaksanaan', 'pelaksanaan.id_pelaksanaan = pemesanan.id_pelaksanaan', 'left')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = pelaksanaan.id_pelanggan', 'left')
                    ->findAll();
    }
}
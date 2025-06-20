<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table      = 'pelanggan'; // Nama tabel di database
    protected $primaryKey = 'id_pelanggan'; // Primary key dari tabel pelanggan

    protected $useAutoIncrement = false; // id_pelanggan adalah varchar, bukan auto-increment integer

    protected $returnType     = 'array'; // Tipe data yang dikembalikan (array)
    protected $useSoftDeletes = false; // Tidak menggunakan soft deletes

    protected $allowedFields = [
        'id_pelanggan',
        'id_survey',
        'id_namasewa',
        'nama_lengkap',
        'no_telpon',
        'tanggal_survey',
        'lokasi_survey'
    ]; // Field-field yang boleh diisi

    protected $useTimestamps = false; // Tidak menggunakan created_at dan updated_at
    protected $dateFormat    = 'date'; // Format tanggal disimpan sebagai DATE di database

    // Anda bisa menambahkan rules validasi di sini jika diperlukan
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
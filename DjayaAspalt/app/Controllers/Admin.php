<?php

namespace App\Controllers;

use App\Models\AlatModel;
use App\Models\PelaksanaanModel;
use App\Models\PelangganModel;
use App\Models\PembayaranModel;
use App\Models\PemesananModel;
use App\Models\PengembalianModel;
use App\Models\PenyewaanModel;
use CodeIgniter\I18n\Time;

class Admin extends BaseController
{
    /**
     * Helper function untuk mengelompokkan data berdasarkan bulan dan tahun.
     */
    private function groupDataByMonth($data, $dateColumn)
    {
        if (empty($data)) {
            return [];
        }
        $grouped = [];
        foreach ($data as $item) {
            $monthYear = Time::parse($item[$dateColumn])->toLocalizedString('MMMM YYYY');
            $grouped[$monthYear][] = $item;
        }
        return $grouped;
    }

    /**
     * Halaman Dashboard Admin
     */
    public function index()
    {
        return view('admin/dashboard');
    }

    /**
     * Halaman-halaman utama untuk setiap modul
     */
    public function manajemenPengguna()
    {
        $model = new PelangganModel();
        $data = [
            'page_title' => 'Manajemen Pelanggan',
            'pelanggan_per_bulan' => $this->groupDataByMonth($model->orderBy('tanggal_survey', 'DESC')->findAll(), 'tanggal_survey')
        ];
        return view('admin/manajemen_pengguna', $data);
    }

    public function dataPelaksanaan()
    {
        $model = new PelaksanaanModel();
        $data = [
            'page_title' => 'Data Pelaksanaan',
            'pelaksanaan_per_bulan' => $this->groupDataByMonth($model->orderBy('tanggal_pelaksanaan', 'DESC')->findAll(), 'tanggal_pelaksanaan')
        ];
        return view('admin/pelaksanaan', $data);
    }

    public function dataPemesanan()
    {
        $model = new PemesananModel();
        $data = [
            // page_title tidak perlu karena akan diambil dari layout khusus
            'pemesanan_per_bulan' => $this->groupDataByMonth($model->orderBy('tanggal_pemesanan', 'DESC')->findAll(), 'tanggal_pemesanan')
        ];
        return view('admin/pemesanan', $data);
    }

    public function dataPenyewaan()
    {
        $model = new PenyewaanModel();
        $data = [
            'page_title' => 'Data Penyewaan',
            'penyewaan_per_bulan' => $this->groupDataByMonth($model->orderBy('tanggal_penyewaan', 'DESC')->findAll(), 'tanggal_penyewaan')
        ];
        return view('admin/penyewaan', $data);
    }

    public function dataAlat()
    {
        $model = new AlatModel();
        $data = [
            'page_title' => 'Data Alat',
            'alat_list' => $model->findAll()
        ];
        return view('admin/alat', $data);
    }

    public function dataPembayaran()
    {
        $model = new PembayaranModel();
        $data = [
            'page_title' => 'Data Pembayaran',
            'pembayaran_per_bulan' => $this->groupDataByMonth($model->orderBy('tanggal_pembayaran', 'DESC')->findAll(), 'tanggal_pembayaran')
        ];
        return view('admin/pembayaran', $data);
    }

    public function dataPengembalian()
    {
        $model = new PengembalianModel();
        $data = [
            'page_title' => 'Data Pengembalian',
            'pengembalian_per_bulan' => $this->groupDataByMonth($model->orderBy('tanggal_pengembalian', 'DESC')->findAll(), 'tanggal_pengembalian')
        ];
        return view('admin/pengembalian', $data);
    }
}
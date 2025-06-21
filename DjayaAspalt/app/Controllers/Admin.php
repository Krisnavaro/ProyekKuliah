<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PelangganModel; // Panggil model baru
use App\Models\PelaksanaanModel;

class Admin extends BaseController
{
    public function index(): string
    {
        return view('admin/dashboard');
    }
    
    public function manajemenPengguna(): string
    {
        $pelangganModel = new PelangganModel();
        $keyword = $this->request->getGet('cari');

        $data['data_per_bulan'] = [];
        $data['nama_bulan_list'] = [];
        $nama_bulan_map = [
            '01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni',
            '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'
        ];

        for ($i = 0; $i < 3; $i++) {
            $timestamp = strtotime("-$i months");
            $bulan_angka = date('m', $timestamp);
            $tahun_angka = date('Y', $timestamp);
            $nama_bulan = $nama_bulan_map[$bulan_angka];
            $data['nama_bulan_list'][] = $nama_bulan;

            $query = $pelangganModel
                ->where('MONTH(tanggal_survey)', $bulan_angka)
                ->where('YEAR(tanggal_survey)', $tahun_angka);

            if ($keyword) {
                $query->like('nama_lengkap', $keyword, 'both');
            }
            
            $data['data_per_bulan'][] = $query->findAll();
        }
        
        $data['keyword'] = $keyword;
        return view('admin/manajemen_pengguna', $data);
    }

    public function tambahPelanggan(): string
    {
        return view('admin/tambah_pelanggan');
    }
    
    public function simpanPelanggan()
    {
        $pelangganModel = new PelangganModel();
        $data = [
            'id_pelanggan' => 'PLG' . date('ymd') . random_int(100, 999),
            'id_survey' => $this->request->getPost('id_survey'),
            'id_namasewa' => $this->request->getPost('id_namasewa'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_telpon' => $this->request->getPost('no_telpon'),
            'tanggal_survey' => $this->request->getPost('tanggal_survey'),
            'lokasi_survey' => $this->request->getPost('lokasi_survey'),
        ];
        $pelangganModel->save($data);
        return redirect()->to('/admin/pelanggan')->with('success', 'Data pelanggan baru berhasil ditambahkan.');
    }

    public function viewPelanggan($id)
    {
        $pelangganModel = new PelangganModel();
        $data['pelanggan'] = $pelangganModel->find($id);
        if (empty($data['pelanggan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pelanggan tidak ditemukan');
        }
        return view('admin/view_pelanggan', $data);
    }

    public function editPelanggan($id)
    {
        $pelangganModel = new PelangganModel();
        $data['pelanggan'] = $pelangganModel->find($id);
        if (empty($data['pelanggan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pelanggan tidak ditemukan');
        }
        return view('admin/edit_pelanggan', $data);
    }

    public function updatePelanggan()
    {
        $pelangganModel = new PelangganModel();
        $id = $this->request->getPost('id_pelanggan');
        $data = [
            'id_survey' => $this->request->getPost('id_survey'),
            'id_namasewa' => $this->request->getPost('id_namasewa'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_telpon' => $this->request->getPost('no_telpon'),
            'tanggal_survey' => $this->request->getPost('tanggal_survey'),
            'lokasi_survey' => $this->request->getPost('lokasi_survey'),
        ];
        $pelangganModel->update($id, $data);
        return redirect()->to('/admin/pelanggan')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function hapusPelanggan($id)
    {
        $pelangganModel = new PelangganModel();
        $pelangganModel->delete($id);
        return redirect()->to('/admin/pelanggan')->with('success', 'Data pelanggan berhasil dihapus.');
    }
    
    // Placeholder untuk fungsi lain
    public function pelaksanaan() { return "Halaman Pelaksanaan"; }
    public function pemesanan() { return "Halaman Pemesanan"; }
    public function penyewaan() { return "Halaman Penyewaan"; }
    public function alat() { return "Halaman Alat"; }
    public function pembayaran() { return "Halaman Pembayaran"; }
    public function pengembalian() { return "Halaman Pengembalian"; }
    public function adminProfile() { return "Halaman Profil Admin"; }
}

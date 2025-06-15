<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PelaksanaanModel;
use App\Models\PenyewaanModel;
use App\Models\AlatModel;
use App\Models\PembayaranModel;
use App\Models\PemesananModel;
use App\Models\PengembalianModel;

class Admin extends BaseController
{
    // Menampilkan Dashboard Admin
    public function index(): string
    {
        return view('admin/dashboard');
    }

    // Menampilkan Halaman Profil Admin dari data Sesi
    public function adminProfile(): string
    {
        $data = [
            'username'     => session()->get('username'),
            'nama_lengkap' => session()->get('nama_lengkap'),
            'email'        => session()->get('email'),
            'role'         => session()->get('role'),
            'foto_profil'  => session()->get('foto_profil')
        ];
        return view('admin/admin_profile', $data);
    }
    
    // Menampilkan form edit profil
    public function editAdminProfile()
    {
        return view('admin/edit_admin_profile');
    }

    // Memproses update profil (termasuk foto)
    public function updateAdminProfile()
    {
        $userModel = new UserModel();
        $adminId = session()->get('user_id');

        // 1. Proses Upload Foto (jika ada file yang diunggah)
        $fileFoto = $this->request->getFile('foto_profil');

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $validationRule = [
                'foto_profil' => [
                    'rules' => 'uploaded[foto_profil]|is_image[foto_profil]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]|max_size[foto_profil,1024]',
                ],
            ];
            if ($this->validate($validationRule)) {
                $userLama = $userModel->find($adminId);
                if ($userLama['foto_profil'] && file_exists('uploads/avatars/' . $userLama['foto_profil'])) {
                    unlink('uploads/avatars/' . $userLama['foto_profil']);
                }
                $namaFotoBaru = $fileFoto->getRandomName();
                $fileFoto->move('uploads/avatars/', $namaFotoBaru);
                $userModel->update($adminId, ['foto_profil' => $namaFotoBaru]);
                session()->set('foto_profil', $namaFotoBaru);
            }
        }

        // 2. Proses Update Data Teks
        $dataUpdate = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        ];
        $userModel->update($adminId, $dataUpdate);
        session()->set('nama_lengkap', $dataUpdate['nama_lengkap']);

        session()->setFlashdata('success', 'Profil admin berhasil diperbarui!');
        return redirect()->to('admin/profile');
    }

    // Menampilkan daftar pelanggan dari database
    public function manajemenPengguna(): string
    {
        $model = new UserModel();
        $data['pelanggan_list'] = $model->where('role', 'pelanggan')->findAll();
        return view('admin/manajemen_pengguna', $data);
    }
    
    // Menampilkan form tambah pelanggan
    public function tambahPelanggan(): string
    {
        return view('admin/tambah_pelanggan');
    }

    // Menyimpan data pelanggan baru
    public function simpanPelanggan(): \CodeIgniter\HTTP\RedirectResponse
    {
        $userModel = new UserModel();
        $rules = [
            'nama_lengkap' => 'required|max_length[100]',
            'username'     => 'required|max_length[50]|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel->save([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'email'        => $this->request->getPost('email'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'         => 'pelanggan',
        ]);

        return redirect()->to('/admin/pelanggan')->with('success', 'Data pelanggan baru berhasil ditambahkan.');
    }

    // Menampilkan daftar pelaksanaan dari database
    public function pelaksanaan(): string
    {
        $model = new PelaksanaanModel();
        $data['pelaksanaan_list'] = $model->getPelaksanaanWithPelanggan();
        return view('admin/pelaksanaan', $data);
    }

    // Menampilkan daftar penyewaan dari database
    public function penyewaan(): string
    {
        $model = new PenyewaanModel();
        $data['penyewaan_list'] = $model->getPenyewaanWithDetails();
        return view('admin/penyewaan', $data);
    }

    // Menampilkan daftar alat dari database
    public function cekStokAlat(): string
    {
        $model = new AlatModel();
        $data['alat_list'] = $model->findAll();
        return view('admin/cek_stok_alat', $data);
    }

    // Menampilkan daftar pembayaran dari database
    public function pembayaran(): string
    {
        $model = new PembayaranModel();
        $data['pembayaran_list'] = $model->findAll();
        return view('admin/pembayaran', $data);
    }

    // Menampilkan daftar pemesanan dari database
    public function pemesanan(): string
    {
        $model = new PemesananModel();
        $data['pemesanan_list'] = $model->getPemesananWithDetails();
        return view('admin/pemesanan', $data);
    }
    
    // Menampilkan daftar pengembalian dari database
    public function pengembalian(): string
    {
        $model = new PengembalianModel();
        $data['pengembalian_list'] = $model->getPengembalianWithDetails();
        return view('admin/pengembalian', $data);
    }
}
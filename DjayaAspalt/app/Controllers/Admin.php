<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PelaksanaanModel;
use App\Models\PemesananModel;

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

        $fileFoto = $this->request->getFile('foto_profil');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $validationRule = [
                'foto_profil' => [
                    'rules' => 'uploaded[foto_profil]|is_image[foto_profil]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]|max_size[foto_profil,1024]',
                ],
            ];
            if ($this->validate($validationRule)) {
                $userLama = $userModel->find($adminId);
                if ($userLama && !empty($userLama['foto_profil']) && file_exists('uploads/avatars/' . $userLama['foto_profil'])) {
                    unlink('uploads/avatars/' . $userLama['foto_profil']);
                }
                $namaFotoBaru = $fileFoto->getRandomName();
                $fileFoto->move('uploads/avatars/', $namaFotoBaru);
                $userModel->update($adminId, ['foto_profil' => $namaFotoBaru]);
                session()->set('foto_profil', $namaFotoBaru);
            }
        }

        $dataUpdate = [ 'nama_lengkap' => $this->request->getPost('nama_lengkap'), ];
        if(!empty($dataUpdate['nama_lengkap'])) {
            $userModel->update($adminId, $dataUpdate);
            session()->set('nama_lengkap', $dataUpdate['nama_lengkap']);
        }

        session()->setFlashdata('success', 'Profil admin berhasil diperbarui!');
        return redirect()->to('admin/profile');
    }

    // --- METODE INI DIUBAH DENGAN DATA LENGKAP ---
    public function manajemenPengguna(): string
    {
        // Data dummy agar tampilan sesuai screenshot
        $data['pelanggan_desember'] = [
            [
                'id_pelanggan' => 'S12122024001',
                'id_survey' => 'Survey12122024001',
                'id_nama_sewa' => '-',
                'nama_lengkap' => 'Samuel Orief Rosario',
                'no_telpon' => '083870126241',
                'tanggal_survey' => '12-12-2024 Jam 07.00 WIB',
                'lokasi' => 'Jl. Bhakti No.48 3, RT.3/RW.7, Cilandak Tim., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12560'
            ],
            [
                'id_pelanggan' => 'S12122024002',
                'id_survey' => '-',
                'id_nama_sewa' => 'Sewa121220241',
                'nama_lengkap' => 'Samuel Orief Rosario',
                'no_telpon' => '083870126241',
                'tanggal_survey' => '-',
                'lokasi' => 'Jl. Bhakti No.48 3, RT.3/RW.7, Cilandak Tim., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12560'
            ],
            // --- DATA BARU DITAMBAHKAN DI SINI ---
            [
                'id_pelanggan' => 'B12122024003',
                'id_survey' => '-',
                'id_nama_sewa' => 'Sewa121220242',
                'nama_lengkap' => 'Bagus Adi Wibowo',
                'no_telpon' => '083888813782',
                'tanggal_survey' => '-',
                'lokasi' => 'Jl.Bangka Raya Gang Amal 4 rt.004/011 no.13, Mampang prapatan, Pela Mampang, Kota Jakarta Selatan.'
            ],
            [
                'id_pelanggan' => 'M12122024004',
                'id_survey' => 'Survey12122024001',
                'id_nama_sewa' => '-',
                'nama_lengkap' => 'Mochamad Rizky Ainur Ridho',
                'no_telpon' => '085885559999',
                'tanggal_survey' => '19-12-2024 Jam 14.00 WIB',
                'lokasi' => 'Jl. Masjid No.83, RT.007/RW.1, Pangkalan Jati Baru, Kec. Cinere, Kota Depok, Jawa Barat 16513'
            ]
        ];

        // Bulan lain kita buat kosong
        $data['pelanggan_november'] = [];
        $data['pelanggan_oktober'] = [];
        
        return view('admin/manajemen_pengguna', $data);
    }
    
    // Menampilkan form tambah pelanggan
    public function tambahPelanggan(): string
    {
        return view('admin/tambah_pelanggan');
    }

    // Menyimpan data pelanggan baru
    public function simpanPelanggan()
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
            'role'         => 'customer',
        ]);
        return redirect()->to('/admin/pelanggan')->with('success', 'Data klien baru berhasil ditambahkan.');
    }
    
    // Menampilkan form edit
    public function editPelanggan($id)
    {
        $userModel = new UserModel();
        $data['pelanggan'] = $userModel->find($id);

        if (empty($data['pelanggan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Klien dengan ID ' . $id . ' tidak ditemukan');
        }

        return view('admin/edit_pelanggan', $data);
    }

    // Menyimpan update data pelanggan
    public function updatePelanggan()
    {
        $userModel = new UserModel();
        $id = $this->request->getPost('id_pelanggan');

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'email'        => $this->request->getPost('email'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);
        return redirect()->to('/admin/pelanggan')->with('success', 'Data klien berhasil diperbarui.');
    }
    
    // Menghapus pelanggan
    public function hapusPelanggan($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/admin/pelanggan')->with('success', 'Data klien berhasil dihapus.');
    }

    // Menampilkan daftar pelaksanaan
    public function pelaksanaan(): string
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $userModel = new UserModel();

        $data['pelaksanaan_list'] = $pelaksanaanModel->findAll();
        $customers = $userModel->where('role', 'customer')->findAll();
        
        $customer_map = [];
        foreach ($customers as $customer) {
            $customer_map[$customer['id']] = $customer['nama_lengkap'];
        }
        $data['customer_map'] = $customer_map;

        return view('admin/pelaksanaan', $data);
    }
    
    // Menampilkan form tambah pelaksanaan
    public function tambahPelaksanaan(): string
    {
        $userModel = new UserModel();
        $data['pelanggan_list'] = $userModel->where('role', 'customer')->findAll();
        return view('admin/tambah_pelaksanaan', $data);
    }

    // Menyimpan data pelaksanaan baru
    public function simpanPelaksanaan()
    {
        $pelaksanaanModel = new PelaksanaanModel();
        
        $data = [
            'id_pelanggan'         => $this->request->getPost('id_pelanggan'),
            'tanggal_pelaksanaan'  => $this->request->getPost('tanggal_pelaksanaan'),
            'alamat_pelaksanaan'   => $this->request->getPost('alamat_pelaksanaan'),
            'waktu_pengerjaan'     => $this->request->getPost('waktu_pengerjaan'),
        ];

        $pelaksanaanModel->save($data);
        return redirect()->to('/admin/pelaksanaan')->with('success', 'Data pelaksanaan baru berhasil ditambahkan.');
    }

    public function kelolaPemesanan()
    {
        $pemesananModel = new PemesananModel();
        $data['pemesanan_list'] = $pemesananModel->getPemesananWithDetails();

        return view('admin/pemesanan', $data);
    }

    public function editPelaksanaan($id)
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $userModel = new UserModel();
        $data['pelaksanaan'] = $pelaksanaanModel->find($id);
        $data['pelanggan_list'] = $userModel->where('role', 'customer')->findAll(); 

        if (empty($data['pelaksanaan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pelaksanaan dengan ID ' . $id . ' tidak ditemukan');
        }

        return view('admin/edit_pelaksanaan', $data);
    }

    public function updatePelaksanaan()
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $id = $this->request->getPost('id_pelaksanaan');

        $data = [
            'id_pelanggan'         => $this->request->getPost('id_pelanggan'),
            'tanggal_pelaksanaan'  => $this->request->getPost('tanggal_pelaksanaan'),
            'alamat_pelaksanaan'   => $this->request->getPost('alamat_pelaksanaan'),
            'waktu_pengerjaan'     => $this->request->getPost('waktu_pengerjaan'),
        ];

        $pelaksanaanModel->update($id, $data);
        return redirect()->to('/admin/pelaksanaan')->with('success', 'Data pelaksanaan berhasil diperbarui.');
    }

    public function hapusDataPelaksanaan($id)
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $pelaksanaanModel->delete($id);
        return redirect()->to('/admin/pelaksanaan')->with('success', 'Data pelaksanaan berhasil dihapus.');
    }
}
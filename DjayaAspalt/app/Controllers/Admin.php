<?php

namespace App\Controllers;

use App\Models\PelaksanaanModel;
use App\Models\PelangganModel;
use App\Models\PemesananModel;
use App\Models\PenyewaanModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function dataPemesanan()
    {
        $pemesananModel = new PemesananModel();
        $data['pemesanan'] = $pemesananModel->getPemesananWithDetails();
        return view('admin/pemesanan', $data);
    }

    public function dataPenyewaan()
    {
        $penyewaanModel = new PenyewaanModel();
        $data['penyewaan'] = $penyewaanModel->getPenyewaanWithDetails();
        return view('admin/penyewaan', $data);
    }

    public function dataPelaksanaan()
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $allPelaksanaan = $pelaksanaanModel->getPelaksanaanWithPelanggan();
    
        $groupedData = [];
        foreach ($allPelaksanaan as $item) {
            $monthYear = date('Y-m', strtotime($item['tanggal_pelaksanaan']));
            if (!isset($groupedData[$monthYear])) {
                $groupedData[$monthYear] = [];
            }
            $groupedData[$monthYear][] = $item;
        }
    
        krsort($groupedData);
    
        $data['pelaksanaan_per_bulan'] = $groupedData;
    
        return view('admin/pelaksanaan', $data);
    }

    // --- METHOD BARU UNTUK PELAKSANAAN ---
    public function tambahPelaksanaan()
    {
        $userModel = new UserModel();
        $data['pelanggan_list'] = $userModel->where('role', 'customer')->findAll();
        return view('admin/tambah_pelaksanaan', $data);
    }

    public function simpanPelaksanaan()
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $data = [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'tanggal_pelaksanaan' => $this->request->getPost('tanggal_pelaksanaan'),
            'alamat_pelaksanaan' => $this->request->getPost('alamat_pelaksanaan'),
            'waktu_pengerjaan' => $this->request->getPost('waktu_pengerjaan'),
        ];
        $pelaksanaanModel->save($data);
        return redirect()->to('/admin/pelaksanaan')->with('success', 'Data pelaksanaan berhasil ditambahkan.');
    }

    public function editPelaksanaan($id)
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $userModel = new UserModel();
        $data['pelaksanaan'] = $pelaksanaanModel->find($id);
        $data['pelanggan_list'] = $userModel->where('role', 'customer')->findAll();
        
        if (empty($data['pelaksanaan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pelaksanaan tidak ditemukan');
        }

        return view('admin/edit_pelaksanaan', $data);
    }

    public function updatePelaksanaan($id)
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $data = [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'tanggal_pelaksanaan' => $this->request->getPost('tanggal_pelaksanaan'),
            'alamat_pelaksanaan' => $this->request->getPost('alamat_pelaksanaan'),
            'waktu_pengerjaan' => $this->request->getPost('waktu_pengerjaan'),
        ];
        $pelaksanaanModel->update($id, $data);
        return redirect()->to('/admin/pelaksanaan')->with('success', 'Data pelaksanaan berhasil diperbarui.');
    }

    public function hapusPelaksanaan($id)
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $pelaksanaanModel->delete($id);
        return redirect()->to('/admin/pelaksanaan')->with('success', 'Data pelaksanaan berhasil dihapus.');
    }
    // ------------------------------------

    public function manajemenPengguna(): string
    {
        return view('admin/manajemen_pengguna');
    }

    public function tambahPelanggan()
    {
        return view('admin/tambah_pelanggan');
    }

    public function simpanPelanggan()
    {
        $pelangganModel = new PelangganModel();
        $id_pelanggan = 'PLG' . date('ymd') . random_int(100, 999);
        $data = [
            'id_pelanggan'   => $id_pelanggan,
            'id_survey'      => $this->request->getPost('id_survey'),
            'id_namasewa'    => $this->request->getPost('id_namasewa'),
            'nama_lengkap'   => $this->request->getPost('nama_lengkap'),
            'no_telpon'      => $this->request->getPost('no_telpon'),
            'tanggal_survey' => $this->request->getPost('tanggal_survey'),
            'lokasi_survey'  => $this->request->getPost('lokasi_survey'),
        ];
        $pelangganModel->save($data);
        return redirect()->to('/admin/pelanggan')->with('success', 'Data pelanggan aktif berhasil ditambahkan.');
    }

    public function viewPelanggan($id)
    {
        $pelangganModel = new PelangganModel();
        $data['pelanggan'] = $pelangganModel->find($id);
        return view('admin/view_pelanggan', $data);
    }

    public function editPelanggan($id)
    {
        $pelangganModel = new PelangganModel();
        $data['pelanggan'] = $pelangganModel->find($id);
        return view('admin/edit_pelanggan', $data);
    }

    public function prosesUpdatePelanggan($id)
    {
        $pelangganModel = new PelangganModel();
        $data = $this->request->getPost();
        $pelangganModel->update($id, $data);
        return redirect()->to('/admin/pelanggan')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function hapusPelanggan($id)
    {
        $pelangganModel = new PelangganModel();
        $pelangganModel->delete($id);
        return redirect()->to('/admin/pelanggan')->with('success', 'Data pelanggan berhasil dihapus.');
    }

    public function adminProfile()
    {
        $userModel = new UserModel();
        $userData = $userModel->find(session()->get('user_id'));
        return view('admin/admin_profile', $userData);
    }

    public function editAdminProfile()
    {
        $userModel = new UserModel();
        $userData = $userModel->find(session()->get('user_id'));
        return view('admin/edit_admin_profile', $userData);
    }

    public function updateAdminProfile()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id'); 

        $rules = [
            'nama_lengkap' => 'required|min_length[3]',
            'email'        => "required|valid_email|is_unique[users.email,id,{$userId}]",
            'foto_profil'  => [
                'rules' => 'is_image[foto_profil]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]|max_size[foto_profil,2048]',
                'label' => 'Foto Profil'
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $dataToUpdate = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'no_telpon'    => $this->request->getPost('no_telpon'),
            'alamat_rumah' => $this->request->getPost('alamat_rumah'),
        ];

        $avatarFile = $this->request->getFile('foto_profil');
        if ($avatarFile && $avatarFile->isValid() && !$avatarFile->hasMoved()) {
            $oldAvatar = session()->get('foto_profil');
            if ($oldAvatar && file_exists('./uploads/avatars/' . $oldAvatar)) {
                unlink('./uploads/avatars/' . $oldAvatar);
            }
            $newName = $avatarFile->getRandomName();
            $avatarFile->move('./uploads/avatars/', $newName);
            $dataToUpdate['foto_profil'] = $newName;
        }

        $userModel->update($userId, $dataToUpdate);

        $newUserData = $userModel->find($userId);
        session()->set($newUserData);

        return redirect()->to('/admin/profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
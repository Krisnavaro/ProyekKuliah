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
        $pemesananModel = new \App\Models\PemesananModel();
        $allPemesanan = $pemesananModel
            ->select('pemesanan.*, pelaksanaan.alamat_pelaksanaan, pelanggan.nama_lengkap')
            ->join('pelaksanaan', 'pelaksanaan.id_pelaksanaan = pemesanan.id_pelaksanaan', 'left')
            ->join('pelanggan', 'pelanggan.id_pelanggan = pelaksanaan.id_pelanggan', 'left')
            ->orderBy('pemesanan.tanggal_pemesanan', 'DESC')
            ->findAll();

        $groupedData = [];
        foreach ($allPemesanan as $item) {
            // Mengelompokkan data berdasarkan Bulan dan Tahun
            $monthYear = date('Y-m', strtotime($item['tanggal_pemesanan']));
            if (!isset($groupedData[$monthYear])) {
                $groupedData[$monthYear] = [];
            }
            $groupedData[$monthYear][] = $item;
        }

        $data['pemesanan_per_bulan'] = $groupedData;

        return view('admin/pemesanan', $data);
    }
    
    public function tambahPemesanan()
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $data['pelaksanaan_list'] = $pelaksanaanModel
            ->select('pelaksanaan.id_pelaksanaan, pelanggan.nama_lengkap, pelaksanaan.alamat_pelaksanaan')
            ->join('pelanggan', 'pelanggan.id_pelanggan = pelaksanaan.id_pelanggan', 'left')
            ->findAll();
            
        return view('admin/tambah_pemesanan', $data);
    }

    public function simpanPemesanan()
    {
        $pemesananModel = new PemesananModel();
        
        $id_pesanan = 'Pesan' . date('dmy') . random_int(100, 999);

        $data = [
            'id_pesanan' => $id_pesanan,
            'id_pelaksanaan' => $this->request->getPost('id_pelaksanaan'),
            'nama_paketdipesan' => $this->request->getPost('nama_paketdipesan'),
            'harga_paketdipesan' => $this->request->getPost('harga_paketdipesan'),
            'tanggal_pemesanan' => $this->request->getPost('tanggal_pemesanan'),
        ];
        $pemesananModel->save($data);
        return redirect()->to('/admin/pemesanan')->with('success', 'Data pemesanan berhasil ditambahkan.');
    }

    public function editPemesanan($id)
    {
        $pemesananModel = new PemesananModel();
        $pelaksanaanModel = new PelaksanaanModel();

        $data['pemesanan'] = $pemesananModel->find($id);
        $data['pelaksanaan_list'] = $pelaksanaanModel
            ->select('pelaksanaan.id_pelaksanaan, pelanggan.nama_lengkap, pelaksanaan.alamat_pelaksanaan')
            ->join('pelanggan', 'pelanggan.id_pelanggan = pelaksanaan.id_pelanggan', 'left')
            ->findAll();

        if (empty($data['pemesanan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pemesanan tidak ditemukan');
        }

        return view('admin/edit_pemesanan', $data);
    }

    public function updatePemesanan($id)
    {
        $pemesananModel = new PemesananModel();
        $data = [
            'id_pelaksanaan' => $this->request->getPost('id_pelaksanaan'),
            'nama_paketdipesan' => $this->request->getPost('nama_paketdipesan'),
            'harga_paketdipesan' => $this->request->getPost('harga_paketdipesan'),
            'tanggal_pemesanan' => $this->request->getPost('tanggal_pemesanan'),
        ];
        $pemesananModel->update($id, $data);
        return redirect()->to('/admin/pemesanan')->with('success', 'Data pemesanan berhasil diperbarui.');
    }

    public function hapusPemesanan($id)
    {
        $pemesananModel = new PemesananModel();
        $pemesananModel->delete($id);
        return redirect()->to('/admin/pemesanan')->with('success', 'Data pemesanan berhasil dihapus.');
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
        $allPelaksanaan = $pelaksanaanModel
            ->select('pelaksanaan.*, pelanggan.nama_lengkap')
            ->join('pelanggan', 'pelanggan.id_pelanggan = pelaksanaan.id_pelanggan', 'left')
            ->findAll();
    
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

    public function tambahPelaksanaan()
    {
        $pelangganModel = new PelangganModel();
        $data['pelanggan_list'] = $pelangganModel->findAll();
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
        $pelangganModel = new PelangganModel();
        $data['pelaksanaan'] = $pelaksanaanModel->find($id);
        $data['pelanggan_list'] = $pelangganModel->findAll();
        
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
    
    public function manajemenPengguna(): string
    {
        $pelangganModel = new PelangganModel();
        $allPelanggan = $pelangganModel->orderBy('tanggal_survey', 'DESC')->findAll();

        $groupedData = [];
        foreach ($allPelanggan as $item) {
            $monthYear = date('Y-m', strtotime($item['tanggal_survey']));
            if (!isset($groupedData[$monthYear])) {
                $groupedData[$monthYear] = [];
            }
            $groupedData[$monthYear][] = $item;
        }
        
        $data['pelanggan_per_bulan'] = $groupedData;

        return view('admin/manajemen_pengguna', $data);
    }

    public function tambahPelanggan()
    {
        return view('admin/tambah_pelanggan');
    }

    public function simpanPelanggan()
    {
        $pelangganModel = new PelangganModel();
        
        $datePrefix = 'S' . date('dmy');
        $todayCountPelanggan = $pelangganModel->like('id_pelanggan', $datePrefix, 'after')->countAllResults();
        $nextSequencePelanggan = str_pad($todayCountPelanggan + 1, 3, '0', STR_PAD_LEFT);
        $id_pelanggan = $datePrefix . $nextSequencePelanggan;

        $jenis_transaksi = $this->request->getPost('jenis_transaksi');
        $id_survey = '-';
        $id_namasewa = '-';

        if ($jenis_transaksi === 'survey') {
            $surveyDatePrefix = 'Survey' . date('dmy');
            $todayCountSurvey = $pelangganModel->like('id_survey', $surveyDatePrefix, 'after')->countAllResults();
            $nextSequenceSurvey = str_pad($todayCountSurvey + 1, 3, '0', STR_PAD_LEFT);
            $id_survey = $surveyDatePrefix . $nextSequenceSurvey;
        } elseif ($jenis_transaksi === 'sewa') {
            $sewaDatePrefix = 'Sewa' . date('dmy');
            $todayCountSewa = $pelangganModel->like('id_namasewa', $sewaDatePrefix, 'after')->countAllResults();
            $nextSequenceSewa = str_pad($todayCountSewa + 1, 3, '0', STR_PAD_LEFT);
            $id_namasewa = $sewaDatePrefix . $nextSequenceSewa;
        }
        
        $data = [
            'id_pelanggan'   => $id_pelanggan,
            'id_survey'      => $id_survey,
            'id_namasewa'    => $id_namasewa,
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
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $userData = $userModel->find($userId);

        if ($userData === null) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Sesi tidak valid. Silakan login kembali.');
        }

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
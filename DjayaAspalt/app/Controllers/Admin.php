<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PelaksanaanModel;
use App\Models\PelangganModel;
use App\Models\PemesananModel;
use App\Models\PenyewaanModel;
use App\Models\PembayaranModel;
use App\Models\PengembalianModel;

class Admin extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
    }

    public function index()
    {
        return view('admin/dashboard');
    }

    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function manajemenPengguna(): string
    {
        $pelangganModel = new PelangganModel();
        $allPelanggan = $pelangganModel->findAll();

        $data['pelanggan_desember'] = [];
        $data['pelanggan_november'] = [];
        $data['pelanggan_oktober'] = [];

        foreach ($allPelanggan as $pelanggan) {
            if (!empty($pelanggan['tanggal_survey']) && $pelanggan['tanggal_survey'] !== '0000-00-00') {
                $tanggalSurvey = new \DateTime($pelanggan['tanggal_survey']);
                $bulan = $tanggalSurvey->format('m');
                $tahun = $tanggalSurvey->format('Y');

                $bulanSekarang = date('m');
                $tahunSekarang = date('Y');

                if ($tahun == $tahunSekarang) {
                    if ($bulan == $bulanSekarang) {
                        $data['pelanggan_desember'][] = [
                            'id_pelanggan' => esc($pelanggan['id_pelanggan']),
                            'id_survey' => esc($pelanggan['id_survey']),
                            'id_nama_sewa' => esc($pelanggan['id_namasewa']),
                            'nama_lengkap' => esc($pelanggan['nama_lengkap']),
                            'no_telpon' => esc($pelanggan['no_telpon']),
                            'tanggal_survey' => esc($pelanggan['tanggal_survey']),
                            'lokasi' => esc($pelanggan['lokasi_survey'])
                        ];
                    } elseif ($bulan == ((int)$bulanSekarang - 1)) {
                        $data['pelanggan_november'][] = [
                            'id_pelanggan' => esc($pelanggan['id_pelanggan']),
                            'id_survey' => esc($pelanggan['id_survey']),
                            'id_nama_sewa' => esc($pelanggan['id_namasewa']),
                            'nama_lengkap' => esc($pelanggan['nama_lengkap']),
                            'no_telpon' => esc($pelanggan['no_telpon']),
                            'tanggal_survey' => esc($pelanggan['tanggal_survey']),
                            'lokasi' => esc($pelanggan['lokasi_survey'])
                        ];
                    } elseif ($bulan == ((int)$bulanSekarang - 2)) {
                        $data['pelanggan_oktober'][] = [
                            'id_pelanggan' => esc($pelanggan['id_pelanggan']),
                            'id_survey' => esc($pelanggan['id_survey']),
                            'id_nama_sewa' => esc($pelanggan['id_namasewa']),
                            'nama_lengkap' => esc($pelanggan['nama_lengkap']),
                            'no_telpon' => esc($pelanggan['no_telpon']),
                            'tanggal_survey' => esc($pelanggan['tanggal_survey']),
                            'lokasi' => esc($pelanggan['lokasi_survey'])
                        ];
                    }
                }
            } else {
                $data['pelanggan_desember'][] = [
                    'id_pelanggan' => esc($pelanggan['id_pelanggan']),
                    'id_survey' => esc($pelanggan['id_survey']),
                    'id_nama_sewa' => esc($pelanggan['id_namasewa']),
                    'nama_lengkap' => esc($pelanggan['nama_lengkap']),
                    'no_telpon' => esc($pelanggan['no_telpon']),
                    'tanggal_survey' => esc($pelanggan['tanggal_survey']),
                    'lokasi' => esc($pelanggan['lokasi_survey'])
                ];
            }
        }

        return view('admin/manajemen_pengguna', $data);
    }

    public function tambahPelanggan()
    {
        return view('admin/tambah_pelanggan');
    }

    public function simpanPelanggan()
    {
        $pelangganModel = new PelangganModel();

        $currentDate = date('ymd');
        $randomSuffix = strtoupper(substr(md5(uniqid(rand(), true)), 0, 4));
        $idPelangganBaru = 'CUST-' . $currentDate . '-' . $randomSuffix;

        $currentTime = date('His');
        $randomSurveySuffix = strtoupper(substr(md5(uniqid(rand(), true)), 0, 4));
        $idSurveyBaru = 'SURVEY-' . $currentDate . '-' . $currentTime . '-' . $randomSurveySuffix;


        $data = [
            'id_pelanggan' => $idPelangganBaru,
            'id_survey' => $idSurveyBaru,
            'id_namasewa' => $this->request->getPost('id_namasewa') ?: '-',
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_telpon' => $this->request->getPost('no_telpon'),
            'tanggal_survey' => $this->request->getPost('tanggal_survey'),
            'lokasi_survey' => $this->request->getPost('lokasi_survey'),
        ];

        $rules = [
            'nama_lengkap' => 'required|max_length[50]',
            'no_telpon' => 'required|max_length[20]',
            'tanggal_survey' => 'required|valid_date', // Sekarang required
            'lokasi_survey' => 'required|max_length[300]', // Sekarang required
            'id_namasewa' => 'max_length[13]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $pelangganModel->insert($data);

        return redirect()->to('/admin/manajemen_pengguna')->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function editPelanggan($id_pelanggan)
    {
        $pelangganModel = new PelangganModel();
        $data['pelanggan'] = $pelangganModel->find($id_pelanggan);

        if (empty($data['pelanggan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pelanggan ' . $id_pelanggan . ' tidak ditemukan.');
        }

        return view('admin/edit_pelanggan', $data);
    }

    public function updatePelanggan()
    {
        $pelangganModel = new PelangganModel();
        $id_pelanggan_lama = $this->request->getPost('id_pelanggan_lama');

        $data = [
            'id_survey' => $this->request->getPost('id_survey') ?: '-',
            'id_namasewa' => $this->request->getPost('id_namasewa') ?: '-',
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_telpon' => $this->request->getPost('no_telpon'),
            'tanggal_survey' => $this->request->getPost('tanggal_survey'),
            'lokasi_survey' => $this->request->getPost('lokasi_survey'),
        ];

        $rules = [
            'nama_lengkap' => 'required|max_length[50]',
            'no_telpon' => 'required|max_length[20]',
            'tanggal_survey' => 'required|valid_date', // Sekarang required
            'lokasi_survey' => 'required|max_length[300]', // Sekarang required
            'id_survey' => 'max_length[17]',
            'id_namasewa' => 'max_length[13]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $pelangganModel->update($id_pelanggan_lama, $data);

        return redirect()->to('/admin/manajemen_pengguna')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function hapusPelanggan($id_pelanggan)
    {
        $pelangganModel = new PelangganModel();
        $pelangganModel->delete($id_pelanggan);
        return redirect()->to('/admin/manajemen_pengguna')->with('success', 'Data pelanggan berhasil dihapus.');
    }

    public function pelaksanaan()
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $data['pelaksanaan'] = $pelaksanaanModel->select('pelaksanaan.*, users.nama_lengkap AS nama_pelanggan')
                                                ->join('users', 'users.id = pelaksanaan.id_pelanggan')
                                                ->findAll();
        return view('admin/pelaksanaan', $data);
    }

    public function tambahPelaksanaan()
    {
        $userModel = new UserModel();
        $data['customers'] = $userModel->where('role', 'customer')->findAll();
        return view('admin/tambah_pelaksanaan', $data);
    }

    public function simpanPelaksanaan()
    {
        $pelaksanaanModel = new PelaksanaanModel();

        $rules = [
            'id_pelanggan' => 'required|numeric',
            'tanggal_pelaksanaan' => 'required|valid_date',
            'alamat_pelaksanaan' => 'required',
            'waktu_pengerjaan' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'tanggal_pelaksanaan' => $this->request->getPost('tanggal_pelaksanaan'),
            'alamat_pelaksanaan' => $this->request->getPost('alamat_pelaksanaan'),
            'waktu_pengerjaan' => $this->request->getPost('waktu_pengerjaan'),
        ];

        $pelaksanaanModel->insert($data);

        return redirect()->to('/admin/pelaksanaan')->with('success', 'Data pelaksanaan berhasil ditambahkan.');
    }

    public function editPelaksanaan($id_pelaksanaan)
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $userModel = new UserModel();

        $data['pelaksanaan'] = $pelaksanaanModel->find($id_pelaksanaan);
        $data['customers'] = $userModel->where('role', 'customer')->findAll();

        if (empty($data['pelaksanaan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pelaksanaan ' . $id_pelaksanaan . ' tidak ditemukan.');
        }

        return view('admin/edit_pelaksanaan', $data);
    }

    public function updatePelaksanaan()
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $id_pelaksanaan = $this->request->getPost('id_pelaksanaan');

        $rules = [
            'id_pelanggan' => 'required|numeric',
            'tanggal_pelaksanaan' => 'required|valid_date',
            'alamat_pelaksanaan' => 'required',
            'waktu_pengerjaan' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'tanggal_pelaksanaan' => $this->request->getPost('tanggal_pelaksanaan'),
            'alamat_pelaksanaan' => $this->request->getPost('alamat_pelaksanaan'),
            'waktu_pengerjaan' => $this->request->getPost('waktu_pengerjaan'),
        ];

        $pelaksanaanModel->update($id_pelaksanaan, $data);

        return redirect()->to('/admin/pelaksanaan')->with('success', 'Data pelaksanaan berhasil diperbarui.');
    }

    public function hapusPelaksanaan($id_pelaksanaan)
    {
        $pelaksanaanModel = new PelaksanaanModel();
        $pelaksanaanModel->delete($id_pelaksanaan);
        return redirect()->to('/admin/pelaksanaan')->with('success', 'Data pelaksanaan berhasil dihapus.');
    }

    public function pemesanan()
    {
        $pemesananModel = new PemesananModel();
        $data['pemesanan'] = $pemesananModel->select('pemesanan.*, pelaksanaan.alamat_pelaksanaan, pelaksanaan.tanggal_pelaksanaan, users.nama_lengkap as nama_pelanggan')
                                             ->join('pelaksanaan', 'pelaksanaan.id_pelaksanaan = pemesanan.id_pelaksanaan', 'left')
                                             ->join('users', 'users.id = pelaksanaan.id_pelanggan', 'left')
                                             ->findAll();
        return view('admin/pemesanan', $data);
    }

    public function penyewaan()
    {
        $penyewaanModel = new PenyewaanModel();
        $data['penyewaan'] = $penyewaanModel->select('penyewaan.*, alat.nama_alat, pelanggan.nama_lengkap as nama_penyewa')
                                            ->join('alat', 'alat.id_alat = penyewaan.id_alat')
                                            ->join('pelanggan', 'pelanggan.id_pelanggan = penyewaan.id_namasewa')
                                            ->findAll();
        return view('admin/penyewaan', $data);
    }

    public function pembayaran()
    {
        $pembayaranModel = new PembayaranModel();
        $data['pembayaran'] = $pembayaranModel->findAll();
        return view('admin/pembayaran', $data);
    }

    public function pengembalian()
    {
        $pengembalianModel = new PengembalianModel();
        $data['pengembalian'] = $pengembalianModel->findAll();
        return view('admin/pengembalian', $data);
    }

    public function adminProfile()
    {
        $session = session();
        $userModel = new UserModel();
        $adminId = $session->get('id');
        $data['admin'] = $userModel->find($adminId);

        if (empty($data['admin'])) {
            return redirect()->to('/')->with('error', 'Admin user not found.');
        }

        return view('admin/admin_profile', $data);
    }

    public function editAdminProfile()
    {
        $session = session();
        $userModel = new UserModel();
        $adminId = $session->get('id');
        $data['admin'] = $userModel->find($adminId);

        if (empty($data['admin'])) {
            return redirect()->to('/')->with('error', 'Admin user not found.');
        }

        return view('admin/edit_admin_profile', $data);
    }

    public function updateAdminProfile()
    {
        $session = session();
        $userModel = new UserModel();
        $adminId = $session->get('id');

        $rules = [
            'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username,id,' . $adminId . ']',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $adminId . ']',
            'nama_lengkap' => 'required|max_length[100]',
            'foto_profil' => 'if_exist|uploaded[foto_profil]|max_size[foto_profil,2048]|ext_in[foto_profil,jpg,jpeg,png,gif]',
        ];

        if ($this->request->getPost('password_baru')) {
            $rules['password_lama'] = 'required|min_length[8]';
            $rules['password_baru'] = 'required|min_length[8]';
            $rules['konfirmasi_password'] = 'required_with[password_baru]|matches[password_baru]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        ];

        if ($this->request->getPost('password_baru')) {
            $admin = $userModel->find($adminId);
            if (!password_verify($this->request->getPost('password_lama'), $admin['password'])) {
                return redirect()->back()->withInput()->with('error', 'Password lama tidak sesuai.');
            }
            $data['password'] = password_hash($this->request->getPost('password_baru'), PASSWORD_DEFAULT);
        }

        $fotoProfil = $this->request->getFile('foto_profil');
        if ($fotoProfil && $fotoProfil->isValid() && !$fotoProfil->hasMoved()) {
            $oldFoto = $userModel->find($adminId)['foto_profil'];
            if ($oldFoto && file_exists(FCPATH . 'uploads/' . $oldFoto)) {
                unlink(FCPATH . 'uploads/' . $oldFoto);
            }
            $newName = $fotoProfil->getRandomName();
            $fotoProfil->move(FCPATH . 'uploads', $newName);
            $data['foto_profil'] = $newName;
        }

        $userModel->update($adminId, $data);

        $session->set([
            'username' => $data['username'],
            'nama_lengkap' => $data['nama_lengkap'],
            'foto_profil' => $data['foto_profil'] ?? $session->get('foto_profil')
        ]);

        return redirect()->to('/admin/profile')->with('success', 'Profil admin berhasil diperbarui.');
    }
}
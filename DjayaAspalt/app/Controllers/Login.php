<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;

class Login extends BaseController
{
    // Tampilkan halaman login
    public function index(): string|RedirectResponse
    {
        // Cegah user login ulang kalau sudah login
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        // Tampilkan modal pilihan login (Pelanggan/Admin)
        return view('login_choice'); // File view baru untuk pilihan login
    }

    // Proses login
    public function login(): RedirectResponse
    {
        $username = $this->request->getPost('username'); // Ini akan menjadi email
        $password = $this->request->getPost('password');
        $loginType = $this->request->getPost('login_type'); // 'customer' atau 'admin'

        // --- PENTING: BAGIAN INI HARUS DIGANTI DENGAN VERIFIKASI DARI DATABASE ---
        // Ini adalah contoh hardcoded untuk DEMO / UJI COBA CEPAT.
        // Dalam produksi, Anda akan query database dan memverifikasi password hash.
        $users = [
            'admin_jasa@djayaspalt.com' => [ // Admin login dengan email ini
                'password' => 'admin123',
                'role' => 'admin',
            ],
            'pelanggan_satu@djayaspalt.com' => [ // Pelanggan login dengan email ini
                'password' => 'passpelanggan',
                'role' => 'customer',
            ],
            // Anda bisa tambahkan user lain di sini
        ];
        // --- AKHIR BAGIAN HARDCODED ---

        if (array_key_exists($username, $users) && $users[$username]['password'] === $password) {
            // Verifikasi login type (misal admin tidak bisa login sebagai customer)
            if ($users[$username]['role'] === $loginType) {
                session()->set('logged_in', true);
                session()->set('username', $username); // Simpan email sebagai username
                session()->set('role', $users[$username]['role']);
                // Simpan data dummy untuk profil pelanggan
                session()->set('nama_lengkap', 'Samuel Orief'); // Contoh data dummy
                session()->set('email', $username); // Email sama dengan username login
                session()->set('no_handphone', '081234567890'); // Contoh no HP dummy
                session()->set('alamat_rumah', 'Jl. Contoh Alamat No. 123'); // Contoh alamat dummy

                return redirect()->to('/dashboard')->with('success', 'Selamat datang, ' . $username . '!');
            } else {
                // Simpan login_type_attempt ke flashdata jika ada error, untuk menampilkan modal yang sama
                session()->setFlashdata('login_type_attempt', $loginType);
                return redirect()->back()->with('error', 'Jenis login tidak sesuai dengan akun.');
            }
        } else {
            // Simpan login_type_attempt ke flashdata jika ada error, untuk menampilkan modal yang sama
            session()->setFlashdata('login_type_attempt', $loginType);
            return redirect()->back()->with('error', 'Email atau Password salah.');
        }
    }

    // Logout
    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to('/');
    }

    // Metode untuk menampilkan form login spesifik (dipanggil dari login_choice)
    public function showLoginForm($type = 'customer'): string|RedirectResponse
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        // Simpan tipe login ke session sementara untuk digunakan di modal
        session()->setFlashdata('current_login_type', $type);
        return view('login', ['login_type' => $type]);
    }
}
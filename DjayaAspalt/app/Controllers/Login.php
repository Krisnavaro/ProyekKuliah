<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function __construct()
    {
        helper('url');
    }

    /**
     * PERUBAHAN DI SINI:
     * Fungsi ini tidak akan menampilkan halaman login terpisah lagi,
     * tapi akan langsung mengarahkan ke dashboard.
     */
    public function showLoginForm()
    {
        // Jika sudah login, arahkan sesuai role
        if (session()->get('logged_in')) {
            if (session()->get('role') === 'admin') {
                return redirect()->to('admin');
            }
            return redirect()->to('dashboard');
        }

        // Jika belum login, arahkan ke dashboard.
        // Nanti di halaman dashboard, modal login akan otomatis muncul.
        return redirect()->to('dashboard');
    }

    /**
     * Fungsi untuk memproses login dari form modal.
     */
    public function login()
    {
        $email = $this->request->getPost('username'); // form menggunakan name 'username'
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->orWhere('username', $email)->first();

        // Menggunakan password_verify untuk keamanan
        if ($user && password_verify($password, $user['password'])) {

            session()->set([
                'user_id'      => $user['id'],
                'username'     => $user['username'],
                'email'        => $user['email'],
                'nama_lengkap' => $user['nama_lengkap'],
                'role'         => $user['role'],
                'foto_profil'  => $user['foto_profil'],
                'logged_in'    => true,
            ]);

            if ($user['role'] === 'admin') {
                return redirect()->to('admin');
            } else {
                return redirect()->to('dashboard');
            }
        } else {
            // Kembali ke halaman sebelumnya dengan pesan error
            return redirect()->back()->withInput()->with('error', 'Email atau Password yang Anda masukkan salah.');
        }
    }

    /**
     * Fungsi untuk logout.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
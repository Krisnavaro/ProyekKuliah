<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function __construct()
    {
        helper('url');
    }

    public function showLoginForm()
    {
        if (session()->get('logged_in')) {
            if (session()->get('role') === 'admin') {
                return redirect()->to('admin');
            }
            return redirect()->to('dashboard');
        }
        return view('auth/login');
    }

    public function login()
    {
        $email = $this->request->getPost('username'); // Nama field dari form adalah 'username', yang diisi email
        $password = $this->request->getPost('password');

        // Menggunakan UserModel untuk otentikasi
        $userModel = new \App\Models\UserModel(); // Pastikan Anda menggunakan UserModel yang sudah dimuat

        // Mencari user berdasarkan email
        $user = $userModel->where('email', $email)->first(); // Cari berdasarkan email

        if ($user && password_verify($password, $user['password'])) { // Verifikasi password
            session()->set([
                'user_id'      => $user['id'],
                'username'     => $user['username'], // Simpan username juga jika perlu
                'email'        => $user['email'],
                'nama_lengkap' => $user['nama_lengkap'], // Ambil nama lengkap dari database
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
            return redirect()->back()->withInput()->with('error', 'Email atau Password yang Anda masukkan salah.');
        }
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
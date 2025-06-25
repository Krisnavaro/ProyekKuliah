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

    public function showLoginForm()
    {
        if (session()->get('logged_in')) {
            if (session()->get('role') === 'admin') {
                return redirect()->to('admin');
            }
            return redirect()->to('dashboard');
        }
        return redirect()->to('dashboard');
    }

    public function login()
    {
        $session = session();
        $emailOrUsername = $this->request->getPost('username'); // Bisa email atau username
        $password = $this->request->getPost('password');

        $userModel = new UserModel();

        // ===================================================================
        // KESALAHAN ADA DI BARIS INI, SEKARANG SUDAH DIPERBAIKI
        // Mencari user berdasarkan email ATAU username
        // ===================================================================
        $user = $userModel->where('email', $emailOrUsername)
                         ->orWhere('username', $emailOrUsername)
                         ->first();

        // Menggunakan password_verify untuk keamanan
        if ($user && password_verify($password, $user['password'])) {

            $ses_data = [
                'user_id'      => $user['id'],
                'username'     => $user['username'],
                'email'        => $user['email'],
                'nama_lengkap' => $user['nama_lengkap'],
                'role'         => $user['role'],
                'foto_profil'  => $user['foto_profil'],
                'logged_in'    => true,
            ];
            $session->set($ses_data);

            // Jika role adalah admin, arahkan ke /admin
            if ($user['role'] === 'admin') {
                return redirect()->to('admin');
            } 
            // Jika bukan admin, arahkan ke /dashboard
            else {
                return redirect()->to('dashboard');
            }

        } else {
            // Kembali ke halaman sebelumnya dengan pesan error
            // Menggunakan flashdata agar pesan hanya muncul sekali
            $session->setFlashdata('error', 'Username atau Password yang Anda masukkan salah.');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
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
        return view('auth/login');
    }

    /**
     * FUNGSI LOGIN SEMENTARA (TANPA HASH) UNTUK DEBUGGING
     */
    public function login()
    {
        $email = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        // PENGECEKAN PASSWORD DIUBAH MENJADI TEKS BIASA (BUKAN HASH)
        if ($user && $password === $user['password']) {

            session()->set([
                'user_id'      => $user['id'],
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
            return redirect()->back()->withInput()->with('error', 'Email atau Password yang Anda masukkan salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
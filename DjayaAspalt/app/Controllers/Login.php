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
        $email = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $users = [
            'admin_jasa@djayaspalt.com' => ['id' => 1, 'password' => 'admin123', 'role' => 'admin', 'nama' => 'Admin Utama'],
            'pelanggan_satu@djayaspalt.com' => ['id' => 2, 'password' => 'passpelanggan', 'role' => 'customer', 'nama' => 'Pelanggan Satu'],
        ];

        if (array_key_exists($email, $users) && $users[$email]['password'] === $password) {
            $userId = $users[$email]['id'];
            $userRole = $users[$email]['role'];
            $userName = $users[$email]['nama'];

            session()->set([
                'user_id'    => $userId,
                'email'      => $email,
                'nama'       => $userName,
                'role'       => $userRole,
                'logged_in'  => true,
            ]);

            if ($userRole === 'admin') {
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
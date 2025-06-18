<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function __construct()
    {
        helper(['form']);
    }

    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        $email = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new \App\Models\UserModel();

        $user = $userModel->where('email', $email)->first();

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
            return redirect()->back()->withInput()->with('error', 'Email atau Password yang Anda masukkan salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Login extends BaseController
{
    public function index(): string|RedirectResponse
    {
        if (session()->get('logged_in')) {
            $role = session()->get('role');
            if ($role === 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->to('/dashboard');
        }
        
        return view('dashboard/index');
    }

    public function process(): RedirectResponse
    {
        $identifier = $this->request->getPost('username'); // Bisa berisi username atau email
        $password = $this->request->getPost('password');

        $model = new UserModel();

        // PERUBAHAN UTAMA: Cari user berdasarkan username ATAU email
        $user = $model->where('username', $identifier)
                      ->orWhere('email', $identifier)
                      ->first();

        if ($user && password_verify($password, $user['password'])) {
            
            $userRole = isset($user['role']) ? trim($user['role']) : '';

            $sessionData = [
                'logged_in'    => true,
                'user_id'      => $user['id'],
                'username'     => $user['username'],
                'email'        => $user['email'],
                'nama_lengkap' => $user['nama_lengkap'],
                'role'         => $userRole,
            ];
            session()->set($sessionData);

            if ($userRole === 'admin') {
                return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang kembali, ' . $user['nama_lengkap'] . '!');
            } else {
                return redirect()->to('/dashboard')->with('success', 'Selamat datang, ' . $user['nama_lengkap'] . '!');
            }
        } else {
            return redirect()->back()->with('error', 'Username/Email atau Password salah.');
        }
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
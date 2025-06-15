<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Register extends BaseController
{
    public function index(): string|RedirectResponse
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('register');
    }

    public function process(): RedirectResponse|string
    {
        helper(['form', 'url']);

        // Aturan validasi untuk semua field, termasuk email
        $rules = [
            'nama_lengkap' => 'required|max_length[100]',
            'username'     => 'required|max_length[50]|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[6]',
            'pass_confirm' => 'required_with[password]|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return view('register', [
                'validation' => $this->validator,
            ]);
        } else {
            $model = new UserModel();

            // Siapkan data untuk disimpan, termasuk email
            $newData = [
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'username'     => $this->request->getPost('username'),
                'email'        => $this->request->getPost('email'),
                'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'         => 'pelanggan',
            ];

            $model->save($newData);

            session()->setFlashdata('success_register', 'Pendaftaran berhasil! Silakan login.');
            return redirect()->to('/login');
        }
    }
}
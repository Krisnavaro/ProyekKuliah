<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
// use App\Models\UserModel; // Uncomment ini jika Anda sudah membuat UserModel

class Register extends BaseController
{
    public function index(): string|RedirectResponse
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('register');
    }

    public function registerUser(): RedirectResponse|string
    {
        helper(['form', 'url']);

        // PENTING: Aturan 'is_unique' di bawah ini sudah DIHAPUS karena Anda belum ada database.
        // Jika nanti sudah ada database, Anda harus menambahkan kembali 'is_unique'
        // dan mengkonfigurasi koneksi database Anda.
        $rules = [
            'nama_lengkap' => 'required|max_length[100]',
            'no_handphone' => 'required|numeric|min_length[10]|max_length[15]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
            'pass_confirm' => 'required_with[password]|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return view('register', [
                'validation' => $this->validator,
            ]);
        } else {
            // Karena kita belum setup database/model, kita simulasikan sukses.
            // Data tidak benar-benar tersimpan permanen.
            session()->setFlashdata('success_register', true); // Flag untuk modal sukses
            return redirect()->to('/dashboard'); // Arahkan ke dashboard untuk menampilkan modal
        }
    }
}
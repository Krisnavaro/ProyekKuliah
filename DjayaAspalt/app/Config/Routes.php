<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::splashScreen'); // Arahkan root ke splash screen

// 🔐 LOGIN & LOGOUT
// Rute untuk pilihan login (Pelanggan/Admin)
$routes->get('login', 'Login::index'); // Mengarah ke Login::index yang akan menampilkan login_choice.php
$routes->get('login/(:segment)', 'Login::showLoginForm/$1'); // Untuk menampilkan form login spesifik
$routes->post('login', 'Login::login'); // Proses login
$routes->get('logout', 'Login::logout'); // Proses logout

// 🆕 Rute untuk Pendaftaran Akun (Register) - BEBAS DIAKSES
$routes->get('register', 'Register::index'); // Tampilkan form pendaftaran (pages/register.php)
$routes->post('register', 'Register::registerUser'); // Proses pendaftaran user

// 🔓 BEBAS DIAKSES TANPA LOGIN (Hanya Halaman Info Umum)
$routes->get('dashboard', 'Pages::dashboard'); // Dashboard utama
$routes->get('gallery', 'Pages::gallery');
$routes->get('hubungi-kami', 'Pages::hubungiKami');
$routes->get('artikel', 'Pages::artikel');
$routes->get('bantuan', 'Pages::bantuan');


// 🔐 HARUS LOGIN - Akses untuk SEMUA Pengguna yang sudah Login (ADMIN/CUSTOMER/CS)
$routes->group('', ['filter' => 'auth'], function($routes) {
    // Rute untuk Profil Perusahaan (Sidebar)
    $routes->get('profile-perusahaan', 'Pages::profilePerusahaan'); // Menggunakan Pages::profilePerusahaan()

    // Rute untuk Biodata Pelanggan (Topbar)
    $routes->get('customer-profile', 'Pages::customerProfile');
    $routes->get('customer-profile/edit', 'Pages::editCustomerProfile');
    $routes->post('customer-profile/update', 'Pages::updateCustomerProfile');

    // Histori Pemesanan dan Penyewaan
    $routes->get('histori-pemesanan', 'Pages::historiPemesanan');
    $routes->get('histori-penyewaan', 'Pages::historiPenyewaan');
});


// 🔐 HARUS LOGIN - Akses KHUSUS PELANGGAN ('customer')
$routes->group('', ['filter' => 'auth:customer'], function($routes) {
    // Pemesanan
    $routes->get('pemesanan', 'Pages::pemesanan'); // Pilih Jasa/Barang
    $routes->get('pemesanan-jasa-barang-form1', 'Pages::pemesananJasaBarangForm1'); // Form Data Survey
    $routes->get('pemesanan-jasa-barang-form2', 'Pages::pemesananJasaBarangForm2'); // Form Data Pelaksanaan
    $routes->get('pemesanan-paket', 'Pages::pemesananPaket'); // Pilih Paket

    // Penyewaan
    $routes->get('penyewaan-barang', 'Pages::penyewaanBarang'); // Pilih Alat
    $routes->get('penyewaan-barang/cek-alat/(:segment)', 'Pages::cekAlat/$1'); // Cek Alat
    $routes->get('penyewaan-barang/form/(:segment)', 'Pages::penyewaanForm/$1'); // Form Penyewaan

    // Keranjang (mode ada item)
    $routes->get('keranjang', 'Pages::keranjang');
    // Jika perlu rute untuk keranjang kosong
    $routes->get('keranjang-kosong', 'Pages::keranjangKosong');

    // Rute pemesanan-jasa yang sudah ada (dari controller PemesananJasa)
    // Jika Anda ingin mengintegrasikan PemesananJasaController ke alur baru, Anda bisa sesuaikan ini.
    // Contoh: $routes->post('pemesanan-jasa/simpan', 'PemesananJasa::simpan');
    $routes->get('jasa-perbaikan', 'Pages::jasaPerbaikan');
});


// 🔐 HARUS LOGIN - Akses KHUSUS ADMIN ('admin')
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('manajemen-pengguna', 'Admin::manajemenPengguna');
    $routes->get('kelola-pemesanan', 'Admin::kelolaPemesanan');
});
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::splashScreen');

// LOGIN & LOGOUT
$routes->get('login', 'Login::showLoginForm');
$routes->post('login', 'Login::login');
$routes->get('logout', 'Login::logout');

// REGISTER
$routes->get('register', 'Register::index');
$routes->post('register', 'Register::registerUser');

// HALAMAN PUBLIK
$routes->get('dashboard', 'Pages::dashboard');
$routes->get('gallery', 'Pages::gallery');
$routes->get('hubungi-kami', 'Pages::hubungiKami');
$routes->get('artikel', 'Pages::artikel');
$routes->get('bantuan', 'Pages::bantuan');

// HALAMAN PELANGGAN (BUTUH LOGIN)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('profile-perusahaan', 'Pages::profilePerusahaan');
    $routes->get('customer-profile', 'Pages::customerProfile');
    $routes->get('customer-profile/edit', 'Pages::editCustomerProfile');
    $routes->post('customer-profile/update', 'Pages::updateCustomerProfile');
    $routes->get('histori-pemesanan', 'Pages::historiPemesanan');
    $routes->get('histori-penyewaan', 'Pages::historiPenyewaan');
});

$routes->group('', ['filter' => 'auth:customer'], function($routes) {
    $routes->get('pemesanan', 'Pages::pemesanan');
    $routes->get('pemesanan-jasa-barang-form1', 'Pages::pemesananJasaBarangForm1');
    $routes->get('pemesanan-jasa-barang-form2', 'Pages::pemesananJasaBarangForm2');
    $routes->get('pemesanan-paket', 'Pages::pemesananPaket');
    $routes->get('penyewaan-barang', 'Pages::penyewaanBarang');
    $routes->get('penyewaan-barang/cek-alat/(:segment)', 'Pages::cekAlat/$1');
    $routes->get('penyewaan-barang/form/(:segment)', 'Pages::penyewaanForm/$1');
    $routes->get('keranjang', 'Pages::keranjang');
    $routes->get('keranjang-kosong', 'Pages::keranjangKosong');
    $routes->get('jasa-perbaikan', 'Pages::jasaPerbaikan');
});

// HALAMAN ADMIN (BUTUH LOGIN ADMIN)
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('pelanggan', 'Admin::manajemenPengguna');
    $routes->get('pelaksanaan', 'Admin::pelaksanaan');
    $routes->get('kelola-pemesanan', 'Admin::kelolaPemesanan');
    $routes->get('profile', 'Admin::adminProfile');
    $routes->get('profile/edit', 'Admin::editAdminProfile');
    $routes->post('profile/update', 'Admin::updateAdminProfile');
    $routes->get('pelanggan/tambah', 'Admin::tambahPelanggan');
    $routes->post('pelanggan/simpan', 'Admin::simpanPelanggan');
    $routes->get('pelanggan/edit/(:num)', 'Admin::editPelanggan/$1');
    $routes->post('pelanggan/update', 'Admin::updatePelanggan');
    $routes->get('pelanggan/hapus/(:num)', 'Admin::hapusPelanggan/$1');
    $routes->get('pelaksanaan/tambah', 'Admin::tambahPelaksanaan');
    $routes->post('pelaksanaan/simpan', 'Admin::simpanPelaksanaan');

    // --- RUTE BARU UNTUK EDIT, UPDATE, & HAPUS PELAKSANAAN ---
    $routes->get('pelaksanaan/edit/(:num)', 'Admin::editPelaksanaan/$1');
    $routes->post('pelaksanaan/update', 'Admin::updatePelaksanaan');
    $routes->get('pelaksanaan/hapus/(:num)', 'Admin::hapusDataPelaksanaan/$1');
});
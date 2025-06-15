<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::splashScreen');

// LOGIN, REGISTER & LOGOUT
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::process');
$routes->get('logout', 'Login::logout');
$routes->get('register', 'Register::index');
$routes->post('register', 'Register::process');

// BEBAS DIAKSES TANPA LOGIN
$routes->get('dashboard', 'Pages::dashboard');
$routes->get('gallery', 'Pages::gallery');
$routes->get('hubungi-kami', 'Pages::hubungiKami');
$routes->get('artikel', 'Pages::artikel');
$routes->get('bantuan', 'Pages::bantuan');

// HARUS LOGIN - AKSES SEMUA PENGGUNA
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('profile-perusahaan', 'Pages::profilePerusahaan');
    $routes->get('customer-profile', 'Pages::customerProfile');
    $routes->get('customer-profile/edit', 'Pages::editCustomerProfile');
    $routes->post('customer-profile/update', 'Pages::updateCustomerProfile');
    $routes->get('histori-pemesanan', 'Pages::historiPemesanan');
    $routes->get('histori-penyewaan', 'Pages::historiPenyewaan');
});

// HARUS LOGIN - AKSES KHUSUS PELANGGAN
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

// HARUS LOGIN - AKSES KHUSUS ADMIN
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('dashboard', 'Admin::index');
    
    // Rute untuk Profil
    $routes->get('profile', 'Admin::adminProfile');
    $routes->get('profile/edit', 'Admin::editAdminProfile'); // RUTE INI YANG MEMPERBAIKI ERROR 404 ANDA
    $routes->post('profile/update', 'Admin::updateAdminProfile');
    
    // Rute untuk Pelanggan
    $routes->get('pelanggan', 'Admin::manajemenPengguna');
    $routes->get('pelanggan/tambah', 'Admin::tambahPelanggan');
    $routes->post('pelanggan/simpan', 'Admin::simpanPelanggan');

    // Rute lainnya
    $routes->get('pelaksanaan', 'Admin::pelaksanaan');
    $routes->get('pemesanan', 'Admin::pemesanan');
    $routes->get('penyewaan', 'Admin::penyewaan');
    $routes->get('alat', 'Admin::cekStokAlat');
    $routes->get('pembayaran', 'Admin::pembayaran');
    $routes->get('pengembalian', 'Admin::pengembalian');
});
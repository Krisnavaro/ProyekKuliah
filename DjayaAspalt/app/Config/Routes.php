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
    
    // Rute untuk Manajemen Klien (users)
    $routes->get('pelanggan', 'Admin::manajemenPengguna');
    $routes->get('pelanggan/tambah', 'Admin::tambahPelanggan');
    $routes->post('pelanggan/simpan', 'Admin::simpanPelanggan');
    $routes->get('pelanggan/edit/(:num)', 'Admin::editPelanggan/$1');
    $routes->post('pelanggan/update', 'Admin::updatePelanggan');
    $routes->get('pelanggan/hapus/(:num)', 'Admin::hapusPelanggan/$1');

    // Rute untuk Manajemen Pelaksanaan
    $routes->get('pelaksanaan', 'Admin::pelaksanaan');
    $routes->get('pelaksanaan/tambah', 'Admin::tambahPelaksanaan');
    $routes->post('pelaksanaan/simpan', 'Admin::simpanPelaksanaan');
    $routes->get('pelaksanaan/edit/(:num)', 'Admin::editPelaksanaan/$1');
    $routes->post('pelaksanaan/update', 'Admin::updatePelaksanaan');
    $routes->get('pelaksanaan/hapus/(:num)', 'Admin::hapusDataPelaksanaan/$1');

    // Rute yang Anda sebut "benar" untuk Pemesanan, Penyewaan, Alat, Pembayaran, Pengembalian
    $routes->get('pemesanan', 'Admin::pemesanan');
    $routes->get('penyewaan', 'Admin::penyewaan');
    $routes->get('alat', 'Admin::cekStokAlat');
    $routes->get('pembayaran', 'Admin::pembayaran');
    $routes->get('pengembalian', 'Admin::pengembalian');

    // Rute untuk Manajemen Profil Admin
    $routes->get('profile', 'Admin::adminProfile');
    $routes->get('profile/edit', 'Admin::editAdminProfile');
    $routes->post('profile/update', 'Admin::updateAdminProfile');

    // >>>>>>> RUTE BARU UNTUK MANAJEMEN DATA PELANGGAN (TABEL 'pelanggan') <<<<<<<
    $routes->get('manajemen-pelanggan-survey', 'Admin::manajemenPelangganSurvey');
    $routes->get('manajemen-pelanggan-survey/tambah', 'Admin::tambahPelangganSurvey');
    $routes->post('manajemen-pelanggan-survey/simpan', 'Admin::simpanPelangganSurvey');
    $routes->get('manajemen-pelanggan-survey/edit/(:segment)', 'Admin::editPelangganSurvey/$1'); // Gunakan :segment karena id_pelanggan varchar
    $routes->post('manajemen-pelanggan-survey/update', 'Admin::updatePelangganSurvey');
    $routes->get('manajemen-pelanggan-survey/hapus/(:segment)', 'Admin::hapusPelangganSurvey/$1'); // Gunakan :segment
    $routes->get('manajemen-pelanggan-survey/detail/(:segment)', 'Admin::detailPelangganSurvey/$1'); // Untuk tombol View
    $routes->get('manajemen-pelanggan-survey/cari', 'Admin::cariPelangganSurvey'); // Untuk tombol Cari
});
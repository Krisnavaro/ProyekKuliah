<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('register', 'Register::index');
$routes->post('register', 'Register::store');

$routes->get('login', 'Login::showLoginForm');
$routes->post('login', 'Login::login');
$routes->get('logout', 'Login::logout');

$routes->get('dashboard', 'Dashboard::index');


//rute halaman
$routes->get('/pages', 'Pages::index');
$routes->get('/artikel', 'Pages::artikel');
$routes->get('/bantuan', 'Pages::bantuan');
$routes->get('/gallery', 'Pages::gallery');
$routes->get('/hubungi_kami', 'Pages::hubungi_kami');
$routes->get('/cek_alat', 'Pages::cek_alat');


// Rute untuk profil pengguna
$routes->get('profile', 'Pages::profile');
$routes->get('profile/edit', 'Pages::editProfile');
$routes->post('profile/update', 'Pages::updateProfile');


//rute pemesanan
$routes->get('/pemesanan', 'PemesananJasa::index');
$routes->post('/pemesanan/save', 'PemesananJasa::save');


$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('/', 'Admin::index');
    // Tambahkan rute admin lainnya di sini
    $routes->get('dashboard', 'Admin::dashboard');

    // INI ADALAH RUTE PENTING YANG MEMPERBAIKI ERROR 404 ANDA
    $routes->get('pelanggan', 'Admin::manajemenPengguna');
    // Rute untuk menambah pengguna
    $routes->get('pelanggan/tambah', 'Admin::tambahPelanggan');
    $routes->post('pelanggan/simpan', 'Admin::simpanPelanggan');

    // Rute untuk mengedit pengguna
    $routes->get('pelanggan/edit/(:num)', 'Admin::editPelanggan/$1');
    $routes->post('pelanggan/update', 'Admin::updatePelanggan');

    // Rute untuk menghapus pengguna
    $routes->get('pelanggan/hapus/(:num)', 'Admin::hapusPelanggan/$1');

    // Rute untuk profil admin
    $routes->get('profile', 'Admin::adminProfile');
    $routes->get('profile/edit', 'Admin::editAdminProfile');
    $routes->post('profile/update', 'Admin::updateAdminProfile');

    // Rute untuk CRUD Pelaksanaan
    $routes->get('pelaksanaan', 'Admin::pelaksanaan');
    $routes->get('pelaksanaan/tambah', 'Admin::tambahPelaksanaan');
    $routes->post('pelaksanaan/simpan', 'Admin::simpanPelaksanaan');
    $routes->get('pelaksanaan/edit/(:num)', 'Admin::editPelaksanaan/$1');
    $routes->post('pelaksanaan/update', 'Admin::updatePelaksanaan');
    $routes->get('pelaksanaan/hapus/(:num)', 'Admin::hapusDataPelaksanaan/$1');

    // Rute untuk CRUD Pemesanan
    $routes->get('kelola-pemesanan', 'Admin::kelolaPemesanan');
    // $routes->get('tambah-pemesanan', 'Admin::tambahPemesanan');
    // $routes->post('simpan-pemesanan', 'Admin::simpanPemesanan');
    // $routes->get('edit-pemesanan/(:any)', 'Admin::editPemesanan/$1');
    // $routes->post('update-pemesanan/(:any)', 'Admin::updatePemesanan/$1');
    // $routes->get('hapus-pemesanan/(:any)', 'Admin::hapusPemesanan/$1');

    // Rute untuk CRUD Penyewaan
    // $routes->get('kelola-penyewaan', 'Admin::kelolaPenyewaan');
    // $routes->get('tambah-penyewaan', 'Admin::tambahPenyewaan');
    // $routes->post('simpan-penyewaan', 'Admin::simpanPenyewaan');
    // $routes->get('edit-penyewaan/(:any)', 'Admin::editPenyewaan/$1');
    // $routes->post('update-penyewaan/(:any)', 'Admin::updatePenyewaan/$1');
    // $routes->get('hapus-penyewaan/(:any)', 'Admin::hapusPenyewaan/$1');

    // Rute untuk CRUD Pengembalian
    // $routes->get('kelola-pengembalian', 'Admin::kelolaPengembalian');
    // $routes->get('tambah-pengembalian', 'Admin::tambahPengembalian');
    // $routes->post('simpan-pengembalian', 'Admin::simpanPengembalian');
    // $routes->get('edit-pengembalian/(:any)', 'Admin::editPengembalian/$1');
    // $routes->post('update-pengembalian/(:any)', 'Admin::updatePengembalian/$1');
    // $routes->get('hapus-pengembalian/(:any)', 'Admin::hapusPengembalian/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
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

// HALAMAN PUBLIK
$routes->get('dashboard', 'Pages::dashboard');
$routes->get('gallery', 'Pages::gallery');

// HALAMAN ADMIN
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('/', 'Admin::index');
    
    // Rute Pelanggan
    $routes->get('pelanggan', 'Admin::manajemenPengguna');
    $routes->get('pelanggan/tambah', 'Admin::tambahPelanggan');
    $routes->post('pelanggan/simpan', 'Admin::simpanPelanggan');
    $routes->get('pelanggan/view/(:any)', 'Admin::viewPelanggan/$1');
    $routes->get('pelanggan/edit/(:any)', 'Admin::editPelanggan/$1');
    $routes->post('pelanggan/update/(:any)', 'Admin::prosesUpdatePelanggan/$1');
    $routes->get('pelanggan/hapus/(:any)', 'Admin::hapusPelanggan/$1');

    // Rute Pelaksanaan (TAMBAHAN BARU)
    $routes->get('pelaksanaan', 'Admin::dataPelaksanaan');
    $routes->get('pelaksanaan/tambah', 'Admin::tambahPelaksanaan');
    $routes->post('pelaksanaan/simpan', 'Admin::simpanPelaksanaan');
    $routes->get('pelaksanaan/edit/(:num)', 'Admin::editPelaksanaan/$1');
    $routes->post('pelaksanaan/update/(:num)', 'Admin::updatePelaksanaan/$1');
    $routes->get('pelaksanaan/hapus/(:num)', 'Admin::hapusPelaksanaan/$1');
    
    // Rute menu lainnya
    $routes->get('pemesanan', 'Admin::dataPemesanan');
    $routes->get('penyewaan', 'Admin::dataPenyewaan');
    
    // Rute profil admin
    $routes->get('profile', 'Admin::adminProfile');
    $routes->get('profile/edit', 'Admin::editAdminProfile');
    $routes->post('profile/update', 'Admin::updateAdminProfile');
});
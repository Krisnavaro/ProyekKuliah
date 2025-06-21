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

// HALAMAN PUBLIK (Contoh)
$routes->get('dashboard', 'Pages::dashboard');
$routes->get('gallery', 'Pages::gallery');

// HALAMAN ADMIN
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('/', 'Admin::index');
    
    // --- RUTE UNTUK SEMUA FUNGSI PELANGGAN ---
    $routes->get('pelanggan', 'Admin::manajemenPengguna');
    $routes->get('pelanggan/tambah', 'Admin::tambahPelanggan');
    $routes->post('pelanggan/simpan', 'Admin::simpanPelanggan');
    $routes->get('pelanggan/view/(:any)', 'Admin::viewPelanggan/$1');
    $routes->get('pelanggan/edit/(:any)', 'Admin::editPelanggan/$1');
    $routes->post('pelanggan/update', 'Admin::updatePelanggan');
    $routes->get('pelanggan/hapus/(:any)', 'Admin::hapusPelanggan/$1');

    // Rute menu lainnya
    $routes->get('pelaksanaan', 'Admin::pelaksanaan');
    $routes->get('pemesanan', 'Admin::pemesanan');
    $routes->get('penyewaan', 'Admin::penyewaan');
    $routes->get('alat', 'Admin::alat');
    $routes->get('pembayaran', 'Admin::pembayaran');
    $routes->get('pengembalian', 'Admin::pengembalian');
    
    // Rute profil admin
    $routes->get('profile', 'Admin::adminProfile');
});

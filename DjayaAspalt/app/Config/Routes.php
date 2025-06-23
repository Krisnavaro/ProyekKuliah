<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ===================================================================
// RUTE HALAMAN PUBLIK & OTENTIKASI
// ===================================================================
$routes->get('/', 'Pages::splashScreen');
$routes->get('login', 'Login::showLoginForm');
$routes->post('login', 'Login::login');
$routes->get('logout', 'Login::logout');
$routes->get('dashboard', 'Pages::dashboard');
$routes->get('gallery', 'Pages::gallery');
$routes->get('hubungi-kami', 'Pages::hubungiKami');
$routes->get('artikel', 'Pages::artikel');
$routes->get('bantuan', 'Pages::bantuan');

// ===================================================================
// RUTE HALAMAN ADMIN (DENGAN FILTER AUTH)
// ===================================================================
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    
    // Dashboard Admin
    $routes->get('/', 'Admin::index');

    // Modul Pelanggan
    $routes->get('pelanggan', 'Admin::manajemenPengguna');
    $routes->get('pelanggan/tambah', 'Admin::tambahPelanggan');
    $routes->post('pelanggan/simpan', 'Admin::simpanPelanggan');

    // Modul Pelaksanaan
    $routes->get('pelaksanaan', 'Admin::dataPelaksanaan');
    $routes->get('pelaksanaan/tambah', 'Admin::tambahPelaksanaan');
    $routes->post('pelaksanaan/simpan', 'Admin::simpanPelaksanaan');
    
    // Modul Pemesanan
    $routes->get('pemesanan', 'Admin::dataPemesanan');
    $routes->get('pemesanan/tambah', 'Admin::tambahPemesanan');
    $routes->post('pemesanan/simpan', 'Admin::simpanPemesanan');

    // Modul Penyewaan
    $routes->get('penyewaan', 'Admin::dataPenyewaan');
    $routes->get('penyewaan/tambah', 'Admin::tambahPenyewaan');
    $routes->post('penyewaan/simpan', 'Admin::simpanPenyewaan');
    
    // Modul Alat
    $routes->get('alat', 'Admin::dataAlat');
    $routes->get('alat/tambah', 'Admin::tambahAlat');
    $routes->post('alat/simpan', 'Admin::simpanAlat');

    // Modul Pembayaran
    $routes->get('pembayaran', 'Admin::dataPembayaran');
    $routes->get('pembayaran/tambah', 'Admin::tambahPembayaran');
    $routes->post('pembayaran/simpan', 'Admin::simpanPembayaran');
    
    // Modul Pengembalian
    $routes->get('pengembalian', 'Admin::dataPengembalian');
    $routes->get('pengembalian/tambah', 'Admin::tambahPengembalian');
    $routes->post('pengembalian/simpan', 'Admin::simpanPengembalian');
    
    // Rute halaman Cek
    $routes->get('cek-paket', 'Admin::cekPaket');
    $routes->get('cek-stok', 'Admin::cekStok');
    $routes->get('cek-stok-full', 'Admin::cekStokFull');
    $routes->get('cek-pekerja', 'Admin::cekPekerja');
    $routes->get('cek-pekerja-detail/(:segment)', 'Admin::cekPekerjaDetail/$1');
    
    // Rute profil
    $routes->get('profile', 'Admin::adminProfile');

});
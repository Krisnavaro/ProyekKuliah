<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;

class Admin extends BaseController
{
    // Dashboard Admin
    public function index(): string
    {
        return view('admin/dashboard');
    }

    // Informasi Akun Admin
    public function adminProfile(): string
    {
        // Data dummy untuk admin
        $data['id_admin'] = 'samsudin10102023';
        $data['nama_lengkap'] = session()->get('nama_lengkap') ?? 'Sam Runner';
        $data['email'] = session()->get('email') ?? 'samrunner141@gmail.com';
        $data['no_handphone'] = session()->get('no_handphone') ?? '081234567891';
        $data['alamat_rumah'] = session()->get('alamat_rumah') ?? 'Jl. Admin Raya No. 1';
        return view('admin/admin_profile', $data);
    }

    // Manajemen Pengguna (Data Pelanggan)
    public function manajemenPengguna(): string
    {
        $data['bulan_desember'] = [
            ['id_pelanggan' => '812122024001', 'id_survey' => 'Survey12122024001', 'id_sewa' => '-', 'nama_lengkap' => 'Samuel Orief Rosario', 'no_telpon' => '083870126241', 'tanggal_survey' => '12-12-2024 Jam 07.00 WIB', 'lokasi' => 'Jl. Bhakti No.48 3, RT.3/RW.7, Cilandak Tim., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12560'],
            ['id_pelanggan' => '812122024002', 'id_survey' => '-', 'id_sewa' => 'Sewa121220241', 'nama_lengkap' => 'Samuel Orief Rosario', 'no_telpon' => '083870126241', 'tanggal_survey' => '-', 'lokasi' => 'Jl. Bhakti No.48 3, RT.3/RW.7, Cilandak Tim., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12560'],
        ];
        $data['bulan_november_ada_data'] = false; // Ganti true jika ada data di bulan November
        return view('admin/manajemen_pengguna', $data);
    }

    // Cek Stok Alat
    public function cekStokAlat(): string
    {
        $data['bulan_desember_ada_data'] = true; // Ganti false jika tidak ada data di bulan Desember
        $data['stok_alat_desember'] = [
            ['id_alat' => 'AlatAspalBesar', 'cek_alat' => 'Tersedia', 'nama_alat' => 'Penggilas Aspal Besar', 'stok_alat' => '1', 'informasi_alat' => 'Alat ini digunakan untuk memadatkan lapisan aspal pada jalan yang sedang dibangun atau diperbaiki. Dengan ukurannya yang besar, alat ini mampu menghasilkan tekanan yang kuat untuk memastikan aspal menjadi padat dan rata.'],
            ['id_alat' => 'AlatAspalKecil', 'cek_alat' => 'Tersedia', 'nama_alat' => 'Penggilas Aspal Kecil', 'stok_alat' => '1', 'informasi_alat' => 'Serupa dengan penggilas aspal besar, alat ini juga digunakan untuk memadatkan aspal, namun ukurannya lebih kecil. Ini membuatnya lebih cocok untuk area yang lebih sempit atau pekerjaan yang memerlukan detail lebih tinggi.'],
        ];
        $data['bulan_november_ada_data'] = false; // Ganti true jika ada data di bulan November
        return view('admin/cek_stok_alat', $data);
    }

    // Cek Paket (Admin)
    public function cekPaket(): string
    {
        // Data paket ini bisa diambil dari database untuk real world
        $data['paket'] = [
            ['nama' => 'Paket A', 'harga' => '70.000', 'layanan' => ['Pembersihan lokasi', 'Cor emulasi', 'Gelar aspal hotmix 2cm', 'Pemadatan baby roller', 'Upah tenaga'], 'status_stok' => 'Masih Banyak'],
            ['nama' => 'Paket B', 'harga' => '85.000', 'layanan' => ['Pembersihan lokasi', 'Tambal sulam batu split', 'Cor emulasi', 'Gelar aspal hotmix 2cm', 'Pemadatan baby roller', 'Upah tenaga'], 'status_stok' => 'Masih Banyak'],
            ['nama' => 'Paket C', 'harga' => '100.000', 'layanan' => ['Pembersihan lokasi', 'Gelar aspal bakar', 'Gelar abu batu', 'Pemadatan wales 4-6 ton', 'Upah tenaga'], 'status_stok' => 'Masih Banyak'],
            ['nama' => 'Paket D', 'harga' => '145.000', 'layanan' => ['Pembersihan lokasi', 'Gelar batu makadam', 'Gelar base course/split', 'Cor emulasi', 'Gelar aspal hotmix 3cm', 'Pemadatan wales 4-6 ton', 'Upah tenaga'], 'status_stok' => 'Masih Banyak'],
        ];
        return view('admin/cek_paket', $data);
    }

    // Cek Stok Material Full
    public function cekStokFull(): string
    {
        $data['materials'] = [
            ['nama' => 'Gelaran Batu Makadam', 'stok' => '31 ton', 'image' => 'Gelaran Batu Makadam.png'],
            ['nama' => 'Gelaran Batu Course/Base', 'stok' => '28 ton', 'image' => 'Gelaran Batu Course Base.png'],
            ['nama' => 'Gelaran Abu Batu', 'stok' => '29 ton', 'image' => 'Gelaran Abu Batu.png'],
            ['nama' => 'Gelaran Batu Split', 'stok' => '36 ton', 'image' => 'Gelaran Batu Split.png'],
            ['nama' => 'Gelaran Aspal Hotmix', 'stok' => '58 ton', 'image' => 'Gelaran Aspal Hotmix.png'],
        ];
        return view('admin/cek_stok_full', $data);
    }

    // Cek Pekerja (Status Ketersediaan)
    public function cekPekerjaStatus(): string
    {
        $data['pekerja_sedang_bekerja'] = 10;
        $data['pekerja_tidak_bekerja'] = 14;
        return view('admin/cek_pekerja_status', $data);
    }

    // Cek Pekerja (Detail Per Pekerja)
    public function cekPekerjaDetail($status = 'bekerja'): string
    {
        $data['pekerja_sedang_bekerja_jumlah'] = 10; // Jumlah total pekerja sedang bekerja
        $data['pekerja_detail'] = [
            'id_pesanan' => 'Pesan1212202401',
            'id_pelanggan' => 'S12122024001',
            'nama' => 'Samuel Orief Rosario',
            'waktu' => '7 Hari',
            'tanggal' => '12-12-2024 sampai 19-12-2024',
            'lokasi' => 'Jl. Bhakti No.48 3, RT.3/RW.7, Cilandak Tim., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12560',
            'status_pengerjaan' => 'Sedang Proses Pengerjaan, Tidak Bisa Di panggil Untuk Melakukan Pekerjaan lain.'
        ];
        // Anda bisa tambahkan logika untuk menampilkan detail jika status 'bekerja'
        return view('admin/cek_pekerja_detail', $data);
    }

    // Data Penyewaan
    public function penyewaan(): string
    {
        $data['bulan_desember'] = [
            ['id_sewa' => 'Sewa121220241', 'id_nama_sewa' => 'Samu121220241', 'cek_alat' => 'Tersedia', 'nama_alat_di_sewa' => 'Penggilas Aspal Besar', 'harga_alat_di_sewa' => 'Rp. 850.000', 'tanggal_penyewaan' => '20-12-2024'],
            ['id_sewa' => 'Sewa121220242', 'id_nama_sewa' => 'Banu121220242', 'cek_alat' => 'Tersedia', 'nama_alat_di_sewa' => 'Penggilas Aspal Kecil', 'harga_alat_di_sewa' => 'Rp. 450.000', 'tanggal_penyewaan' => '09-12-2024'],
        ];
        $data['bulan_november_ada_data'] = false;
        return view('admin/penyewaan', $data);
    }

    // Data Pemesanan
    public function pemesanan(): string
    {
        $data['bulan_desember'] = [
            ['id_pesanan' => 'Pesan1212202401', 'id_pelaksanaan' => 'Pelaksanaan1212202401', 'nama_paket_di_pesan' => 'Paket A', 'harga_paket_di_pesan' => 'Rp. 70.000', 'tanggal_pemesanan' => '12-12-2024'],
            ['id_pesanan' => 'Pesan1212202402', 'id_pelaksanaan' => 'Pelaksanaan1212202402', 'nama_paket_di_pesan' => 'Paket B', 'harga_paket_di_pesan' => 'Rp. 85.000', 'tanggal_pemesanan' => '17-12-2024'],
        ];
        $data['bulan_november_ada_data'] = false;
        return view('admin/pemesanan', $data);
    }

    // Data Pelaksanaan
    public function pelaksanaan(): string
    {
        $data['bulan_desember'] = [
            ['id_pelaksanaan' => 'Pelaksanaan1212202401', 'id_pelanggan' => 'S12122024001', 'tanggal_pelaksanaan' => '12-12-2024 Jam 10.00 WIB', 'alamat_pelaksanaan' => 'Jl. Bhakti No.48 3, RT.3/RW.7, Cilandak Tim., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12560', 'waktu_pengerjaan' => '7 hari'],
            ['id_pelaksanaan' => 'Pelaksanaan1212202402', 'id_pelanggan' => 'M12122024004', 'tanggal_pelaksanaan' => '20-12-2024 Jam 09.00 WIB', 'alamat_pelaksanaan' => 'Jl. Masjid, No.83, RT.001/RW.1, Pangkalan Jati Baru, Kec. Cinere, Kota Depok, Jawa Barat 16513', 'waktu_pengerjaan' => 'Sampai Selesai'],
        ];
        $data['bulan_november_ada_data'] = false;
        return view('admin/pelaksanaan', $data);
    }

    // Data Pembayaran
    public function pembayaran(): string
    {
        $data['bulan_desember'] = [
            ['id_bayar' => 'Bayar1212202401', 'id_pesanan' => 'Pesan1212202401', 'id_sewa' => '-', 'tanggal_pembayaran' => '12-12-2024', 'metode_pembayaran' => 'BCA', 'no_rekening' => '2100132349'],
            ['id_bayar' => 'Bayar1212202402', 'id_pesanan' => 'Pesan1212202402', 'id_sewa' => '-', 'tanggal_pembayaran' => '17-12-2024', 'metode_pembayaran' => 'BCA', 'no_rekening' => '2100145234'],
            ['id_bayar' => 'Bayar1212202403', 'id_pesanan' => '-', 'id_sewa' => 'Sewa121220241', 'tanggal_pembayaran' => '20-12-2024', 'metode_pembayaran' => 'BCA', 'no_rekening' => '2100132349'],
            ['id_bayar' => 'Bayar1212202404', 'id_pesanan' => '-', 'id_sewa' => 'Sewa121220242', 'tanggal_pembayaran' => '09-12-2024', 'metode_pembayaran' => 'BCA', 'no_rekening' => '2100998324'],
        ];
        $data['bulan_november_ada_data'] = false;
        return view('admin/pembayaran', $data);
    }

    // Bukti Pembayaran
    public function buktiPembayaran(): string
    {
        $data['bulan_desember'] = [
            ['id_bayar' => 'Bayar1212202401', 'nama' => 'Samuel Orief Rosario', 'id_pesanan' => 'Pesan1212202401', 'jumlah' => 'Rp. 1.905.000,00'],
            ['id_bayar' => 'Bayar1212202402', 'nama' => 'Samuel Orief Rosario', 'id_pesanan' => 'Pesan1212202402', 'jumlah' => 'Rp. 2.000.000,00'],
            ['id_bayar' => 'Bayar1212202403', 'nama' => 'Bagus Adi Wibowo', 'id_pesanan' => '-', 'jumlah' => 'Rp. 850.000,00'],
            ['id_bayar' => 'Bayar1212202404', 'nama' => 'Mochamad Rizky Ainur Ridho', 'id_pesanan' => '-', 'jumlah' => 'Rp. 450.000,00'],
        ];
        $data['bulan_november_ada_data'] = false;
        return view('admin/bukti_pembayaran', $data);
    }

    // Detail Bukti Pembayaran
    public function detailBuktiPembayaran($id_bayar = null): string
    {
        // Data dummy untuk detail bukti pembayaran
        $data['detail'] = [
            'id_bayar' => $id_bayar,
            'dari_rekening' => '2100132349',
            'ke_rekening' => '4980175516',
            'paket_nama' => 'Paket A',
            'jumlah_bayar' => '1.905.000,00',
            'atas_nama' => 'samuel orief rosario',
            'bukti_screenshot' => 'm_transfer_screenshot.png' // Gambar screenshot m-banking
        ];
        return view('admin/detail_bukti_pembayaran', $data);
    }

    // Pengembalian
    public function pengembalian(): string
    {
        $data['bulan_desember'] = [
            ['id_kembali' => 'Balik2112202401', 'id_bayar' => 'Bayar1212202403', 'nama_alat_di_sewa' => 'Penggilas Aspal Besar', 'denda_kembali' => 'Rp. 0', 'tanggal_pengembalian' => '21-12-2024'],
            ['id_kembali' => 'Balik1012202402', 'id_bayar' => 'Bayar1212202404', 'nama_alat_di_sewa' => 'Penggilas Aspal Kecil', 'denda_kembali' => 'Rp. 0', 'tanggal_pengembalian' => '10-12-2024'],
        ];
        $data['bulan_november_ada_data'] = false;
        return view('admin/pengembalian', $data);
    }

    // Edit Profile Admin
    public function editAdminProfile() {
        $data['nama_lengkap'] = session()->get('nama_lengkap') ?? 'Sam Runner';
        $data['no_handphone'] = session()->get('no_handphone') ?? '08xxxxxxxxxx';
        $data['email'] = session()->get('email') ?? 'email@example.com';
        $data['alamat_rumah'] = session()->get('alamat_rumah') ?? 'Alamat Rumah Anda';
        return view('admin/edit_admin_profile', $data);
    }
    // Update Profile Admin (simulasi)
    public function updateAdminProfile() {
        $namaLengkapBaru = $this->request->getPost('nama_lengkap');
        $noHandphoneBaru = $this->request->getPost('no_handphone');
        $alamatRumahBaru = $this->request->getPost('alamat_rumah');

        session()->set('nama_lengkap', $namaLengkapBaru);
        session()->set('no_handphone', $noHandphoneBaru);
        session()->set('alamat_rumah', $alamatRumahBaru);

        session()->setFlashdata('success', 'Profil admin berhasil diperbarui!');
        return redirect()->to('admin/profile'); // Arahkan kembali ke halaman profil admin
    }
}
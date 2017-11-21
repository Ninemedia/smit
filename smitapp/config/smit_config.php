<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is additional config settings
 * Please only add additional config here
 *
 * @author	Iqbal
 */

/**
 * Coming soon
 */
$config['coming_soon']          = FALSE;

/**
 * Maintenance
 */
$config['maintenance']          = FALSE;

/**
 * Month
 */
$config['month']                = array(
	1  => 'Januari',
	2  => 'Februari',
	3  => 'Maret',
	4  => 'April',
	5  => 'Mei',
	6  => 'Juni',
	7  => 'Juli',
	8  => 'Agustus',
	9  => 'September',
	10 => 'Oktober',
	11 => 'Nopember',
	12 => 'Desember',
);

/**
 * Captcha
 */
$config['captcha_site_key']         = '6LcBRxgUAAAAACaXG3Iq8z9agk6ZX8AYOPIOYbPR';
$config['captcha_secret_key']       = '6LcBRxgUAAAAAHSSJX690oQHlgNo99MCWBPqSTYI';
$config['captcha_verify_url']       = 'https://www.google.com/recaptcha/api/siteverify';

/**
 * User Type
 */
$config['user_type']                = array(
    ADMINISTRATOR                   => 'Administrator',
    PENDAMPING                      => 'Pendamping',
    TENANT                          => 'Tenant',
    JURI                            => 'Juri',
    PENGUSUL                        => 'Pengusul',
    PELAKSANA                       => 'Pelaksana',
    //PELAKSANA_TENANT                => 'Pelaksana &amp; Tenant',
);

/**
 * User Status
 */
$config['user_status']              = array(
    NONACTIVE                       => 'Belum Aktif',
    ACTIVE                          => 'Aktif',
    BANNED                          => 'Banned',
    DELETED                         => 'Dihapus',
);

/**
 * User Workunit Status
 */
$config['user_workunit_status']              = array(
    NONACTIVE                       => 'NON LIPI',
    ACTIVE                          => 'LIPI',
);

/**
 * Status
 */
$config['files_status']             = array(
    NONACTIVE                       => 'Belum Diterima',
    ACTIVE                          => 'Diterima',
    BANNED                          => 'Banned',
    DELETED                         => 'Dihapus',
);

/**
 * IKM Status
 */
$config['ikm_status']              = array(
    SANGAT_SETUJU                   => 'Sangat Setuju',
    SETUJU                          => 'Setuju',
    TIDAK_SETUJU                    => 'Tidak Setuju',
    SANGAT_TIDAK_SETUJU             => 'Sangat Tidak Setuju',
);

/**
 * IKM Nilai
 */
$config['ikm_nilai']              = array(
    SANGAT_SETUJU                   => 100,
    SETUJU                          => 75,
    TIDAK_SETUJU                    => 50,
    SANGAT_TIDAK_SETUJU             => 25,
);

/**
 * User Status
 */
$config['user_status_message']      = array(
    UNREAD                          => 'Belum Dibaca',
    READ                            => 'Dibaca',
    INSIDE                          => 'Dibalas'
);

/**
 * Incubation Selection Status
 */
// Tahap 1
$config['incsel_status']            = array(
    NOTCONFIRMED                    => 'Belum Dikonfirmasi',
    CONFIRMED                       => 'Dikonfirmasi',
    RATED                           => 'Dinilai',
    ACCEPTED                        => 'Masuk Tahap 2',
    REJECTED                        => 'Tidak Lulus',
);

// Tahap 2
$config['incsel_status_steptwo']    = array(
    NOTCONFIRMED                    => 'Belum Dikonfirmasi',
    CONFIRMED                       => 'Dikonfirmasi',
    RATED                           => 'Dinilai',
    ACCEPTED                        => 'Lulus',
    REJECTED                        => 'Tidak Lulus',
);

/**
 * Incubation Selection Report Status
 */
$config['incsel_report_status']     = array(
    REPORT_CALLED                   => 'Dipanggil',
    REPORT_REJECTED                 => 'Ditolak',
);

/**
 * User Menu Access
 */
$config['user_menu_access']             = array(
    ADMINISTRATOR                       => array(
        'beranda',
        // ------------------- PENGGUNA
        'pengguna',
        'pengguna/tambah',
        'pengguna/daftar',
        'pengguna/info',
        // ------------------- SELEKSI PRA-INKUBASI
        'seleksiprainkubasi',
        'seleksiprainkubasi/pengaturan',
        'seleksiprainkubasi/daftar',
        'seleksiprainkubasi/nilai',
        'seleksiprainkubasi/peringkat',
        'seleksiprainkubasi/riwayat',
        // ------------------- PRA-INKUBASI
        'prainkubasi',
        //'prainkubasi/tambah',
        'prainkubasi/daftar',
        //'prainkubasi/tambahproduk',
        'prainkubasi/produk',
        'prainkubasi/pendampingan',
        'prainkubasi/laporan',
        // ------------------- SELEKSI INKUBASI
        'seleksiinkubasi',
        'seleksiinkubasi/pengaturan',
        'seleksiinkubasi/daftar',
        'seleksiinkubasi/nilai',
        'seleksiinkubasi/peringkat',
        'seleksiinkubasi/riwayat',
        // ------------------- KEGIATAN INKUBASI/TENANT
        //'inkubasi/pendampingan',
        //'inkubasi/laporan',
        'tenants',
        'tenants/daftarinkubasi',
        'tenants/daftar',
        //'tenants/pendaftaran',
        'tenants/pendampingan',
        'tenants/blogs',
        //'tenants/tambahproduk',
        'tenants/produk',
        'tenants/pembayaran',
        'tenants/laporan',
        'monitoring_dokumen',
        // ------------------- PENDAMPINGAN
        'pendamping',
        /*'pendamping/daftar',*/
        'pendamping/notulensiprainkubasi',
        'pendamping/notulensiinkubasi',
        // ------------------- BERITA
        'berita',
        'berita/daftar',
        'berita/tambah',
        // ------------------- INFO GRAFIS
        'infografis',
        'infografis/pengguna',
        'infografis/prainkubasi',
        'infografis/inkubasi',
        'infografis/ikm',

        'berkas',
        'berkas/digital',
        'pengumuman',
        'layanan',
        'layanan/pesanumum',
        'layanan/komunikasi',
        'layanan/pengukuranikm',
        'pengaturan',
        'pengaturan/depan',
        'pengaturan/belakang',
        //'pengaturan/satuankerja',
    ),
    PENDAMPING                          => array(
        'beranda',
        'prainkubasi',
        'prainkubasi/pendampingan',
        'prainkubasi/laporan',
        'tenants',
        'tenants/pendampingan',
        'tenants/laporan',
        'pendamping',
        'pendamping/notulensiprainkubasi',
        'pendamping/notulensiinkubasi',
        'pengumuman',
        //'layanan',
        //'layanan/komunikasi',
        'diskusi'
    ),
    TENANT                              => array(
        'beranda',
        'tenants',
        'tenants/blogs',
        'tenants/daftar',
        //'tenants/pendaftaran',
        'tenants/pendampingan',
        //'tenants/tambahproduk',
        'tenants/produk',
        //'tenants/pembayaran',
        'tenants/laporan',
        'monitoring_dokumen',
        'pengumuman',
        //'layanan',
        //'layanan/komunikasi',
        'diskusi'
    ),
    JURI                                => array(
        'beranda',
        'seleksiprainkubasi',
        'seleksiprainkubasi/nilai',
        'seleksiprainkubasi/peringkat',
        'seleksiprainkubasi/riwayat',
        'seleksiinkubasi',
        'seleksiinkubasi/nilai',
        'seleksiinkubasi/peringkat',
        'seleksiinkubasi/riwayat',
        'pengumuman',
        //'layanan',
        //'layanan/komunikasi',
        'diskusi'
    ),
    PENGUSUL                            => array(
        'beranda',
        'seleksiprainkubasi',
        //'seleksiprainkubasi/daftar',
        'seleksiprainkubasi/nilai',
        'seleksiprainkubasi/peringkat',
        'seleksiprainkubasi/riwayat',
        'seleksiinkubasi',
        //'seleksiinkubasi/daftar',
        'seleksiinkubasi/nilai',
        'seleksiinkubasi/peringkat',
        'seleksiinkubasi/riwayat',
        'pengumuman',
        //'layanan',
        //'layanan/komunikasi',
        'diskusi'
    ),
    PELAKSANA                           => array(
        'beranda',
        'prainkubasi',
        'prainkubasi/daftar',
        'prainkubasi/pendampingan',
        //'prainkubasi/tambahproduk',
        'prainkubasi/produk',
        //'prainkubasi/tambahlaporan',
        'prainkubasi/laporan',
        'monitoring_dokumen',
        'panduan',
        'panduan/berkas',
        'pengumuman',
        //'layanan',
        //'layanan/komunikasi',
        'diskusi'
    ),
    PELAKSANA_TENANT                    => array(
        'beranda',
        'seleksiprainkubasi',
        'seleksiprainkubasi/daftar',
        'seleksiprainkubasi/nilai',
        'seleksiprainkubasi/peringkat',
        'seleksiprainkubasi/riwayat',
        'prainkubasi',
        'prainkubasi/daftar',
        'prainkubasi/pendampingan',
        //'prainkubasi/tambahproduk',
        'prainkubasi/produk',
        //'prainkubasi/tambahlaporan',
        'prainkubasi/laporan',
        'seleksiinkubasi',
        'seleksiinkubasi/daftar',
        'seleksiinkubasi/nilai',
        'seleksiinkubasi/peringkat',
        'seleksiinkubasi/riwayat',
        'tenants',
        'tenants/daftarinkubasi',
        'tenants/blogs',
        'tenants/daftar',
        //'tenants/pendaftaran',
        'tenants/pendampingan',
        //'tenants/tambahproduk',
        'tenants/produk',
        'tenants/pembayaran',
        'tenants/laporan',
        'panduan',
        'panduan/berkas',
        'pengumuman',
        //'layanan',
        //'layanan/komunikasi',
        'diskusi'
    )
);

/**
 * Religion
 */
$config['religion']                 = array(
    MOSLEM                          => 'Islam',
    PROTESTANT                      => 'Kristen Protestan',
    CATHOLIC                        => 'Kristen Katolik',
    HINDU                           => 'Hindu',
    BUDDHA                          => 'Budha',
    KONGHUCHU                       => 'Konghuchu',
);

/**
 * Bulan Laporan
 */
$config['month_report']             = array(
    1                       		=> 'Bulan 1',
    2                          		=> 'Bulan 2',
    3                          		=> 'Bulan 3',
    4                         		=> 'Bulan 4',
    5                         		=> 'Bulan 5',
    6                         		=> 'Bulan 6',
    7                         		=> 'Bulan 7',
    8                         		=> 'Bulan 8',
    9                         		=> 'Bulan 9',
    10                         		=> 'Bulan 10',
);
//incubatior
$config['month_report_incubation']             = array(
    1                       		=> 'Bulan 1',
    2                          		=> 'Bulan 2',
    3                          		=> 'Bulan 3',
    4                         		=> 'Bulan 4',
    5                         		=> 'Bulan 5',
    6                         		=> 'Bulan 6',
    7                         		=> 'Bulan 7',
    8                         		=> 'Bulan 8',
    9                         		=> 'Bulan 9',
    10                         		=> 'Bulan 10',
    11                         		=> 'Bulan 11',
    12                         		=> 'Bulan 12',
);

/**
 * Email config
 */
$config['email_active']             = TRUE;
$config['mailserver_host']		    = 'smtp.gmail.com';
$config['mailserver_port']		    = '465';
$config['mailserver_username'] 	    = 'radenrifalardiansyah@gmail.com';
$config['mailserver_password'] 	    = 'hdw20rra5566';

// automatic logout
$config['idle_timeout']             = 1800;  // in seconds

/**
 * Lost Permission
 */
$config['ip_lost_permission']       = array(
    '127.0.0.1',
    '202.62.17.244'
);

/* End of file smit_config.php */
/* Location: ./application/config/smit_config.php */

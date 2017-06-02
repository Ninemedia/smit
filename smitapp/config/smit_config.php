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
    PELAKSANA                       => 'Pelaksana'
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
 * Incubation Selection Status
 */
$config['incsel_status']            = array(
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
$config['user_menu_access']         = array(
    ADMINISTRATOR                   => array(
        'beranda',
        // ------------------- PENGGUNA 
        'pengguna',
        'pengguna/tambah',
        'pengguna/daftar',
        /*
        'company',
        'company/list',
        'company/setting',
        */
        // ------------------- SELEKSI PRA-INKUBASI 
        'seleksiprainkubasi',
        'seleksiprainkubasi/pengaturan',
        'seleksiprainkubasi/daftar',
        'seleksiprainkubasi/nilai',
        'seleksiprainkubasi/peringkat',
        'seleksiprainkubasi/riwayat',
        // ------------------- PRA-INKUBASI
        'prainkubasi',
        'prainkubasi/tambah',
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
        'tenants/blogs',
        'tenants/daftar',
        'tenants/pendaftaran',
        'tenants/pendampingan',
        'tenants/produk',
        'tenants/pembayaran',
        'tenants/laporan',
        'pendamping',
        /*'pendamping/daftar',*/
        'pendamping/laporan',
        'berita',
        'berita/daftar',
        'berita/tambah',
        'statistik',
        'statistik/pengguna',
        'statistik/prainkubasi',
        'statistik/inkubasi',
        'statistik/tenant',
        'panduan',
        'panduan/berkas',
        'pengumuman',
        'layanan',
        'pengaturan',
        'pengaturan/depan',
        'pengaturan/belakang',
        //'pengaturan/satuankerja',
    ),
    PENDAMPING                      => array(
        'beranda',
        'prainkubasi',
        'prainkubasi/tambah',
        'prainkubasi/pendampingan',
        'prainkubasi/laporan',
        'tenants',
        'tenants/daftar',
        'tenants/pendampingan',
        'tenants/laporan',
        'pendamping',
        'pendamping/tambah',
        'pendamping/laporan',
        'layanan',
    ),
    TENANT                          => array(
        'beranda',
        'tenants',
        'tenants/blogs',
        'tenants/daftar',
        'tenants/pendaftaran',
        'tenants/pendampingan',
        'tenants/produk',
        'tenants/pembayaran',
        'tenants/laporan',
        'layanan',
    ),
    JURI                            => array(
        'beranda',
        'seleksiprainkubasi',
        'seleksiprainkubasi/nilai',
        'seleksiprainkubasi/peringkat',
        'seleksiprainkubasi/riwayat',
        'seleksiinkubasi',
        'seleksiinkubasi/nilai',
        'seleksiinkubasi/peringkat',
        'seleksiinkubasi/riwayat',
        'layanan',
    ),
    PENGUSUL                        => array(
        'beranda',
        'seleksiprainkubasi',
        'seleksiprainkubasi/nilai',
        'seleksiprainkubasi/peringkat',
        'seleksiprainkubasi/riwayat',
        'seleksiinkubasi',
        'seleksiinkubasi/nilai',
        'seleksiinkubasi/peringkat',
        'seleksiinkubasi/riwayat',
        'layanan',
    ),
    PELAKSANA                        => array(
        'beranda',
        'prainkubasi',
        'prainkubasi/nilai',
        'prainkubasi/laporan',
        //'inkubasi',
        //'inkubasi/nilai',
        //'inkubasi/laporan',
        /*
        'tenants',
        'tenants/blogs',
        'tenants/pendaftaran',
        'tenants/pendampingan',
        'tenants/produk',
        'tenants/pembayaran',
        'tenants/laporan',
        */
        'panduan',
        'panduan/berkas',
        'pengumuman',
        'layanan',
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
 * Email config
 */
$config['email_active']             = TRUE;
$config['mailserver_host']		    = '';
$config['mailserver_username'] 	    = '';
$config['mailserver_password'] 	    = '';

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
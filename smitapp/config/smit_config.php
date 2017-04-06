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
    EXAMINED                        => 'Diperiksa',
    CALLED                          => 'Dipanggil',
    RATED                           => 'Dinilai',
    ACCEPTED                        => 'Diterima',
    REJECTED                        => 'Ditolak',
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
        'pengguna',
        'pengguna/daftar',
        'pengguna/tambah',
        /*
        'company',
        'company/list',
        'company/setting',
        */
        'prainkubasi',
        'prainkubasi/daftar',
        'prainkubasi/pengaturan',
        'prainkubasi/nilai',
        'prainkubasi/laporan',
        'inkubasi',
        'inkubasi/daftar',
        //'inkubasi/pengaturan',
        'inkubasi/nilai',
        'inkubasi/laporan',
        'tenants',
        'tenants/blogs',
        'tenants/daftar',
        'tenants/pendaftaran',
        'tenants/pendampingan',
        'tenants/produk',
        'tenants/pembayaran',
        'tenants/laporan',
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
    ),
    PENDAMPING                      => array(
        'beranda',
        'tenants',
        'tenants/daftar',
        'tenants/pendampingan',
        'tenants/laporan',
        'layanan',
    ),
    TENANT                          => array(
        'beranda',
        'inkubasi',
        'tenant',
        'layanan',
    ),
    JURI                            => array(
        'beranda',
        'inkubasi',
        'prainkubasi',
        'prainkubasi/nilai',
        'prainkubasi/laporan',
        'inkubasi',
        'inkubasi/nilai',
        'inkubasi/laporan',
        'layanan',
    ),
    PENGUSUL                        => array(
        'beranda',
        'prainkubasi',
        'prainkubasi/nilai',
        'prainkubasi/laporan',
        'inkubasi',
        'inkubasi/nilai',
        'inkubasi/laporan',
        'pengumuman',
        'layanan',
    ),
    PELAKSANA                        => array(
        'beranda',
        'prainkubasi',
        'prainkubasi/nilai',
        'prainkubasi/laporan',
        'inkubasi',
        'inkubasi/nilai',
        'inkubasi/laporan',
        'tenants',
        'tenants/blogs',
        'tenants/daftar',
        'tenants/pendaftaran',
        'tenants/pendampingan',
        'tenants/produk',
        'tenants/pembayaran',
        'tenants/laporan',
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
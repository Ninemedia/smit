<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['translate_uri_dashes']          = FALSE;
$route['default_controller']            = "frontend";
$route['404_override']                  = "frontend";

// -------------------------------------------------------------------------
// User Page Routes
// -------------------------------------------------------------------------
$route['login']                         = "user/login";
$route['logout']                        = "user/logout";
$route['validate']                      = "user/validate";
$route['forgot']                        = "user/forgot";
$route['registration']                  = "user/registration";
$route['selectprovince']                = "user/selectprovince";
$route['pengguna/daftar']               = "user/userlist";
$route['pengguna/tambah']               = "user/useradd";
$route['pengguna/profil']               = "user/userprofile";
$route['pengguna/profil/(:num)']        = "user/userprofile/$1";
$route['userlistdata']                  = "user/userlistdata";
$route['userconfirm/(:any)/(:num)']     = "user/userconfirm/$1/$2";
$route['signup']                        = "user/signup";
// -------------------------------------------------------------------------

// -------------------------------------------------------------------------
// Backend Page Routes
// -------------------------------------------------------------------------
$route['beranda']                               = "backend";
// Pra Incubation Page Routes
$route['selectionsetting']                      = "praincubation/praincubationsettingsave";
// Menu Seleksi Pra-Inkubasi
$route['seleksiprainkubasi/pengaturan']         = "praincubation/praincubationsetting";
$route['daftarprainkubasi']                     = "praincubation/praincubationsettinglistdata";
$route['detilprainkubasi/(:any)']               = "praincubation/praincubationsettingdetails/$1";
$route['tutupprainkubasi/(:any)']               = "praincubation/praincubationsettingclose/$1";
$route['seleksiprainkubasi/daftar']             = "praincubation/praincubationlist";
$route['seleksiprainkubasi/daftar/detail/(:any)']= "praincubation/praincubationdetails/$1";
$route['seleksiprainkubasi/daftardata/(:any)']  = "praincubation/praincubationlistdata/$1";
$route['seleksiprainkubasi/daftardatastep1']    = "praincubation/praincubationlistdatastep1";
$route['seleksiprainkubasi/daftardatastep2']    = "praincubation/praincubationlistdatastep2";
$route['seleksiprainkubasi/konfirmasi']         = "praincubation/praincubationconfirm";
$route['seleksiprainkubasi/konfirmasi/(:any)']  = "praincubation/praincubationconfirm/$1";
$route['seleksiprainkubasi/konfirmasistep1']           = "praincubation/praincubationconfirmstep1";
$route['seleksiprainkubasi/konfirmasistep1/(:any)']    = "praincubation/praincubationconfirmstep1/$1";
$route['seleksiprainkubasi/konfirmasistep2']           = "praincubation/praincubationconfirmstep2";
$route['seleksiprainkubasi/konfirmasistep2/(:any)']    = "praincubation/praincubationconfirmstep2/$1";
$route['seleksiprainkubasi/nilai']                     = "praincubation/praincubationscore";
$route['seleksiprainkubasi/nilai/detail/step1/(:num)'] = "praincubation/admindetailscorestep1/$1";
$route['seleksiprainkubasi/nilai/detail/step2/(:num)'] = "praincubation/admindetailscorestep2/$1";
$route['seleksiprainkubasi/nilai/detail/(:num)/(:any)']= "praincubation/adminscoreuser/$1/$2";
$route['seleksiprainkubasi/adminnilaidata/(:any)']     = "praincubation/adminscorelistdata/$1";
$route['seleksiprainkubasi/adminnilaidatastep1']       = "praincubation/adminscorelistdatastep1";
$route['seleksiprainkubasi/adminnilaidatastep2']       = "praincubation/adminscorelistdatastep2";
$route['seleksiprainkubasi/riwayat']                   = "praincubation/praincubationhistory";
$route['seleksiprainkubasi/riwayatdata']               = "praincubation/historylistdata";
$route['seleksiprainkubasi/riwayatdata/(:num)']        = "praincubation/historylistdata/$1";
$route['seleksiprainkubasi/peringkat']                 = "praincubation/ranking";
// --------------------------------------------------------------------------
// Menu Kegiatan Pra-Inkubasi
$route['prainkubasi/pendampingan']              = "praincubation/accompanimentlist";
$route['prainkubasi/pendampingan/detail/(:any)']= "praincubation/companionassignment/$1";
$route['prainkubasi/daftarpendampingan']        = "praincubation/accompanimentlistdata";
$route['prainkubasi/daftarditerima']            = "praincubation/praincubationacceptedlistdata";
$route['prainkubasi/laporan']                   = "praincubation/praincubationreport";
$route['prainkubasi/laporan/step1']             = "praincubation/juryreportdatastep1";
$route['prainkubasi/laporan/step2']             = "praincubation/juryreportdatastep2";
// --------------------------------------------------------------------------
// Menu Penilaian
// Juri
$route['prainkubasi/jurinilaidata/(:any)']      = "praincubation/juryscorelistdata/$1";
$route['prainkubasi/jurinilaidatastep1']        = "praincubation/juryscorelistdatastep1";
$route['prainkubasi/jurinilaidatastep2']        = "praincubation/juryscorelistdatastep2";
$route['prainkubasi/nilai/(:num)/(:any)']       = "praincubation/juryscoreuser/$1/$2";
$route['prainkubasi/prosesnilai/(:num)']        = "praincubation/juryscoreuserprocess/$1";
$route['prainkubasi/laporan/konfirmasi']        = "praincubation/praincubationreportconfirm";
$route['prainkubasi/laporan/konfirmasi/(:any)'] = "praincubation/praincubationreportconfirm/$1";
$route['prainkubasi/unduh/(:any)']              = "praincubation/downloadfile/$1";
$route['praincubationconfirm']                  = "praincubation/praincubationconfirm";
$route['praincubationconfirm/(:any)']           = "praincubation/praincubationconfirm/$1";
$route['praincubationreportconfirm']            = "praincubation/praincubationreportconfirm";
$route['praincubationreportconfirm/(:any)']     = "praincubation/praincubationreportconfirm/$1";
$route['praincubationscoreact/(:any)/(:any)']   = "praincubation/praincubationscoreaction/$1/$2";
$route['penilaianseleksi/(:any)']               = "praincubation/praincubationselectiondetails/$1";
$route['detailseleksi/(:any)']                  = "praincubation/praincubationselectiondetails/$1";

// --------------------------------------------------------------------------
// Menu Seleksi Inkubasi
$route['seleksiinkubasi/pengaturan']            = "incubation/incubationsetting";
$route['seleksiinkubasi/daftar']                = "incubation/incubationlist";
$route['seleksiinkubasi/laporan']               = "incubation/incubationreport";
$route['seleksiinkubasi/daftardatastep1']       = "incubation/incubationlistdatastep1";
$route['seleksiinkubasi/daftardatastep2']       = "incubation/incubationlistdatastep2";
$route['seleksiinkubasi/daftar/detail/(:any)']  = "incubation/incubationdetails/$1";
$route['seleksiinkubasi/unduh/(:any)']          = "incubation/downloadfile/$1";
$route['seleksiinkubasi/konfirmasi']                = "incubation/incubationconfirm";
$route['seleksiinkubasi/konfirmasi/(:any)']         = "incubation/incubationconfirm/$1";
$route['seleksiinkubasi/konfirmasistep1']           = "incubation/incubationconfirmstep1";
$route['seleksiinkubasi/konfirmasistep1/(:any)']    = "incubation/incubationconfirmstep1/$1";
$route['seleksiinkubasi/konfirmasistep2']           = "incubation/incubationconfirmstep2";
$route['seleksiinkubasi/konfirmasistep2/(:any)']    = "incubation/incubationconfirmstep2/$1";
$route['seleksiinkubasi/riwayat']                   = "incubation/incubationhistory";
$route['seleksiinkubasi/riwayatdata']               = "incubation/historylistdata";
$route['seleksiinkubasi/riwayatdata/(:num)']        = "incubation/historylistdata/$1";

// Menu Penilaian
$route['seleksiinkubasi/adminnilaidata/(:any)']     = "incubation/adminscorelistdata/$1";
$route['seleksiinkubasi/adminnilaidatastep1']       = "incubation/adminscorelistdatastep1";
$route['seleksiinkubasi/adminnilaidatastep2']       = "incubation/adminscorelistdatastep2";
$route['seleksiinkubasi/nilai']                     = "incubation/incubationscore";
$route['seleksiinkubasi/nilai/detail/step1/(:num)'] = "incubation/admindetailscorestep1/$1";
$route['seleksiinkubasi/nilai/detail/step2/(:num)'] = "incubation/admindetailscorestep2/$1";
$route['seleksiinkubasi/nilai/detail/(:num)/(:any)']= "incubation/adminscoreuser/$1/$2";
// Juri
$route['inkubasi/jurinilaidata/(:any)']         = "incubation/juryscorelistdata/$1";
$route['inkubasi/jurinilaidatastep1']           = "incubation/juryscorelistdatastep1";
$route['inkubasi/jurinilaidatastep2']           = "incubation/juryscorelistdatastep2";
$route['inkubasi/nilai']                        = "incubation/incubationscore";
$route['inkubasi/nilai/(:num)/(:any)']          = "incubation/juryscoreuser/$1/$2";
$route['inkubasi/prosesnilai/(:num)']           = "incubation/juryscoreuserprocess/$1";
// Menu Pengaturan
$route['inkubasi/pengaturan']                   = "incubation/incubationsetting";
$route['daftarseleksiinkubasi']                 = "incubation/incubationsettinglistdata";
$route['detilseleksiinkubasi/(:any)']           = "incubation/incubationsettingdetails/$1";
$route['tutupseleksiinkubasi/(:any)']           = "incubation/incubationsettingclose/$1";
$route['incubationselectionsetting']            = "incubation/incubationsettingsave";




$route['incubationsetlist']                     = "incubation/incubationsettinglistdata";
$route['incubationsetdetails/(:any)']           = "incubation/incubationsettingdetails/$1";
$route['incubationsetclose/(:any)']             = "incubation/incubationsettingclose/$1";
$route['incubationconfirm']                     = "incubation/incubationconfirm";
$route['incubationconfirm/(:any)']              = "incubation/incubationconfirm/$1";
$route['incubationreportconfirm']               = "incubation/incubationreportconfirm";
$route['incubationreportconfirm/(:any)']        = "incubation/incubationreportconfirm/$1";
$route['incubationscoreact/(:any)/(:any)']      = "incubation/incubationscoreaction/$1/$2";
$route['incubationdownloadfile/(:any)']         = "incubation/incubationdownloadfile/$1";
$route['juryscoresetdetails/(:any)']            = "incubation/juryscoredatadetails/$1";
$route['juryscoresetnilai/(:any)']              = "incubation/juryscoredatanilai/$1";
// Tenant Page Routes
$route['tenants/blogs']                         = "tenant/tenantblogs";
$route['tenants/daftar']                        = "tenant/tenantdata";
$route['tenants/pendampingan']                  = "tenant/tenantaccompaniment";
$route['tenants/produk']                        = "tenant/tenantproduct";
$route['tenants/pembayaran']                    = "tenant/tenantpayment";
$route['tenants/laporan']                       = "tenant/tenantreport";
$route['tenants/pendaftaran']                   = "tenant/tenantadd";
$route['tenants/tenantlistdata']                = "tenant/tenantlistdata";
$route['tenants/daftar/detail/(:any)']          = "tenant/tenantlistdetails/$1";
$route['tenants/konfirmasi/(:any)/(:num)']      = "tenant/tenantconfirm/$1/$2";

// Setting 
$route['pengaturan/depan']              = "backend/settingfrontend";
$route['pengaturan/belakang']           = "backend/settingbackend";
$route['pengaturan/satuankerja']        = "backend/workunit";
$route['workunitconfirm/(:any)/(:num)'] = "backend/workunitconfirm/$1/$2";
// Announcements
$route['pengumuman']                    = "backend/announcements";
$route['pengumuman/detail/(:any)']      = "backend/announcementdetails/$1";
$route['announcements/details/(:any)']  = "backend/announcementdatadetails/$1";
$route['announcementslist']             = "backend/announcementuserlistdata";
// Guide Files
$route['panduan/berkas']                = "backend/guides";
// Services
$route['layanan']                       = "backend/services";
// News
$route['berita']                        = "backend/news";
$route['berita/detail/(:any)']          = "backend/newsdetails/$1";
// All
$route['company/list']                  = "backend/listcompany";
$route['company/detail']                = "backend/detailcompany";
$route['company/setting']               = "backend/settingcompany";
$route['unduh/(:any)']                  = "backend/guidesdownloadfile/$1";
// -------------------------------------------------------------------------


// -------------------------------------------------------------------------
// Frontend Page Routes
// -------------------------------------------------------------------------
// 1. Home 
// 2. About Me (Profile)
$route['profil']                        = "frontend/profile";
$route['tentangkami/profil']            = "frontend/profile";
/*
$route['tentangkami/layanan']           = "frontend/services";
$route['tentangkami/artikel']           = "frontend/article";
*/
// 3. Selection
$route['seleksi/pengumuman']            = "frontend/announcement";
$route['seleksi/pengumuman/(:any)']     = "frontend/announcementdetails/$1";
$route['announcementlist']              = "frontend/announcementlistdata";
$route['seleksi/prainkubasi']           = "frontend/selectionpraincubation";
$route['seleksi/inkubasi']              = "frontend/selectionincubation";
// 4. Pra-Incubation
$route['prainkubasi/daftarprainkubasi'] = "frontend/listpraincubation";
$route['prainkubasi/produkprainkubasi'] = "frontend/productpraincubation";
// 5. Incubation/Tenant
$route['tenant/daftartenant']           = "frontend/listtenant";
$route['tenant/produktenant']           = "frontend/producttenant";
$route['tenant/fasilitastenant']        = "frontend/fasilitiestenant";
$route['tenant/blogtenant']             = "frontend/blogtenant";
/*
$route['tenant/kategoritenant']         = "frontend/blogcategory";
*/
// 6. Berkas Digital
$route['berkasdigital']                 = "frontend/guide";
// 7. Info Grafis
$route['infografis']                    = "frontend/statistic";
// 8. Contact
$route['kontak']                        = "frontend/contact";

// All
$route['unduhberkas/(:any)']                = "frontend/guidesdownloadfile/$1";
$route['unduhberkas/prainkubasi/(:any)']    = "frontend/praincubationdownloadfile/$1";
// -------------------------------------------------------------------------

/* End of file routes.php */
/* Location: ./application/config/routes.php */

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
$route['beranda']                     = "backend";
// Pra Incubation Page Routes
$route['prainkubasi/daftar']            = "praincubation/incubationlist";
$route['prainkubasi/pengaturan']        = "praincubation/incubationsetting";
$route['prainkubasi/nilai']             = "praincubation/incubationscore";
$route['prainkubasi/laporan']           = "praincubation/incubationreport";
// Incubation Page Routes
$route['inkubasi/daftar']               = "incubation/incubationlist";
$route['inkubasi/pengaturan']           = "incubation/incubationsetting";
$route['inkubasi/nilai']                = "incubation/incubationscore";
$route['inkubasi/laporan']              = "incubation/incubationreport";

$route['selectionsetting']              = "incubation/incubationsettingsave";
$route['incubationsetlist']             = "incubation/incubationsettinglistdata";
$route['incubationsetdetails/(:any)']   = "incubation/incubationsettingdetails/$1";
$route['incubationsetclose/(:any)']     = "incubation/incubationsettingclose/$1";
$route['incubationconfirm']             = "incubation/incubationconfirm";
$route['incubationconfirm/(:any)']      = "incubation/incubationconfirm/$1";
$route['incubationreportconfirm']       = "incubation/incubationreportconfirm";
$route['incubationreportconfirm/(:any)']= "incubation/incubationreportconfirm/$1";
$route['incubationscoreact/(:any)/(:any)'] = "incubation/incubationscoreaction/$1/$2";
$route['incubationdownloadfile/(:any)'] = "incubation/incubationdownloadfile/$1";
$route['juryscoresetdetails/(:any)']    = "incubation/juryscoredatadetails/$1";
$route['juryscoresetnilai/(:any)']      = "incubation/juryscoredatanilai/$1";
// Tenant Page Routes
$route['tenants/blogs']                 = "tenant/tenantblogs";
$route['tenants/daftar']                = "tenant/tenantdata";
$route['tenants/pendampingan']          = "tenant/tenantaccompaniment";
$route['tenants/produk']                = "tenant/tenantproduct";
$route['tenants/pembayaran']            = "tenant/tenantpayment";
$route['tenants/laporan']               = "tenant/tenantreport";
// Setting 
$route['pengaturan/depan']              = "backend/settingfrontend";
$route['pengaturan/belakang']           = "backend/settingbackend";
// Announcements
$route['pengumuman']                    = "backend/announcements";
$route['announcements/details/(:any)']  = "backend/announcementdatadetails/$1";
$route['announcementslist']             = "backend/announcementuserlistdata";
$route['pengumuman/(:any)']             = "backend/announcementdetails/$1";
// Guide Files
$route['panduan/berkas']                = "backend/guides";
// Services
$route['layanan']                       = "backend/services";
// All
$route['company/list']                  = "backend/listcompany";
$route['company/detail']                = "backend/detailcompany";
$route['company/setting']               = "backend/settingcompany";
// -------------------------------------------------------------------------


// -------------------------------------------------------------------------
// Frontend Page Routes
// -------------------------------------------------------------------------
// About Me
$route['tentangkami/profil']            = "frontend/profile";
$route['tentangkami/layanan']           = "frontend/services";
$route['tentangkami/artikel']           = "frontend/article";
// Incubation
$route['seleksi/prainkubasi']           = "frontend/selectionpraincubation";
$route['seleksi/inkubasi']              = "frontend/selectionincubation";
// Tenant
$route['tenant/daftar']                 = "frontend/listtenant";
$route['tenant/produk']                 = "frontend/producttenant";
$route['tenant/fasilitas']              = "frontend/fasilitiestenant";
$route['tenant/blog']                   = "frontend/blogtenant";
$route['tenant/kategori']               = "frontend/blogcategory";
// Information
$route['informasi/panduan']             = "frontend/guide";
$route['informasi/pengumuman']          = "frontend/announcement";
$route['informasi/pengumuman/(:any)']   = "frontend/announcementdetails/$1";
$route['announcementlist']              = "frontend/announcementlistdata";
// Statistic
$route['statistik']                    = "frontend/statistic";
// Contact
$route['kontak']                        = "frontend/contact";
// -------------------------------------------------------------------------

/* End of file routes.php */
/* Location: ./application/config/routes.php */

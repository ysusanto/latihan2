<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "admin/home_admin/login";
$route['404_override'] = '';

//$route['manage'] = "web/manage";
//$route['manage/(:any)'] = "web/manage/$1";
//$route['manage/(:any)/(:any)'] = "web/manage/$1/$2";
//
//$route['register'] = "web/register";
//$route['register/(:any)'] = "web/register/$1";
//$route['register/(:any)/(:any)'] = "web/register/$1/$2";
//
//$route['login'] = "web/login";
//$route['login/(:any)'] = "web/login/$1";
//$route['login/(:any)/(:any)'] = "web/login/$1/$2";
//
//$route['shop'] = "web/shop";
//$route['shop/(:any)'] = "web/shop/$1";
//$route['shop/(:any)/(:any)'] = "web/shop/$1/$2";
//
//$route['edit'] = "web/edit";
//$route['edit/(:any)'] = "web/edit/$1";
//$route['edit/(:any)/(:any)'] = "web/edit/$1/$2";
//
//$route['follow'] = "web/follow";
//$route['follow/(:any)'] = "web/follow/$1";
//$route['follow/(:any)/(:any)'] = "web/follow/$1/$2";
//
//$route['sync'] = "web/synchronize/test";
//$route['userdata'] = "web/synchronize/getdatauser";
//$route['userdata/(:any)'] = "web/synchronize/$1";
//
//$route['sync/kategori'] = "web/synchronize/synckategori";
//
//$route['admin']="admin/home_admin/login";
$route['admin/(:any)'] = "admin/home_admin/$1";
$route['admin/(:any)/(:any)'] = "admin/home_admin/$1/$2";
//
//$route['useraccess']="admin/useraccess/viewuser";
//$route['useraccess/(:any)'] = "admin/useraccess/$1";
//$route['useraccess/(:any)/(:any)'] = "admin/useraccess/$1/$2";
//
$route['perusahaan']="admin/perusahaan/viewperusahaan";
$route['perusahaan/(:any)'] = "admin/perusahaan/$1";
$route['perusahaan/(:any)/(:any)'] = "admin/perusahaan/$1/$2";

$route['lowongan']="admin/lowongan/viewlowongan";
$route['lowongan/(:any)'] = "admin/lowongan/$1";
$route['lowongan/(:any)/(:any)'] = "admin/lowongan/$1/$2";

$route['pekerja']="admin/pekerja/viewpekerja";
$route['pekerja/(:any)'] = "admin/pekerja/$1";
$route['pekerja/(:any)/(:any)'] = "admin/pekerja/$1/$2";

$route['training']="admin/training/viewtraining";
$route['training/(:any)'] = "admin/training/$1";
$route['training/(:any)/(:any)'] = "admin/training/$1/$2";
//
//
//$route['addusercms']="admin/home_admin/registercms";
//
$route['clogin']="admin/clogin/";
$route['clogin/(:any)'] = "admin/clogin/$1";
$route['clogin/(:any)/(:any)'] = "admin/clogin/$1/$2";
//
//$route['kategori']="admin/lookup/viewkategori";
//$route['kategori/(:any)'] = "admin/lookup/$1";
//$route['kategori/(:any)/(:any)'] = "admin/lookup/$1/$2";
/* End of file routes.php */
/* Location: ./application/config/routes.php */
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
//$route['default_controller'] = "ws_global/index";
$route['default_controller'] = "home";
$route['404_override'] = '';


$route['register'] = "home/register";
$route['tki'] = "home/profiltki";
$route['kursus'] = "home/profilkursus";
$route['pt'] = "home/profilpt";
$route['broadcast'] = "home/broadcastloker";


$route['afterloagin']='home/afterlogin';
$route['profilekursus']='home/profile_kursus';
//$route['testing/ngecek'] = "testing/ngecek";
//$route['testing/getCollectionData'] = "testing/getCollectionData";
//$route['testing/getCollectionData/(:any)'] = "testing/getCollectionData/$1";
//$route['testing/getCollectionData/(:any)/(:any)'] = "testing/getCollectionData/$1/$2";
//$route['testing/getCollectionData/(:any)/(:any)/(:any)'] = "testing/getCollectionData/$1/$2/$3";
//$route['testing/getCollectionDataEcho'] = "testing/getCollectionDataEcho";
//$route['testing/getCollectionDataEcho/(:any)'] = "testing/getCollectionDataEcho/$1";
//$route['testing/getCollectionDataEcho/(:any)/(:any)'] = "testing/getCollectionDataEcho/$1/$2";
//$route['testing/getCollectionDataEcho/(:any)/(:any)/(:any)'] = "testing/getCollectionDataEcho/$1/$2/$3";
//$route['listdb'] = "testing/listCollections";
//$route['testing/seeInsideCollection/(:any)'] = "testing/seeInsideCollection/$1";
//$route['testing/channel2'] = "testing/channel2";
//$route['testing/channel2/(:any)'] = "testing/channel2/$1";
//$route['testing/deleteRecord'] = "testing/deleteRecord";
//$route['testing/deleteRecord/(:any)'] = "testing/deleteRecord/$1";
//$route['testing/deleteRecord/(:any)/(:any)'] = "testing/deleteRecord/$1/$2";
//$route['ws'] = "ws_global/index";
$route['test/(:any)'] = "test/$1";
$route['test/invite/(:any)'] = "home/inv2/$1";
$route['test/(:any)'] = "test/$1";

$route['(:any)/(:any)'] = "$1/$2";

$route['manage'] = "web/manage";
$route['manage/(:any)'] = "web/manage/$1";
$route['manage/(:any)/(:any)'] = "web/manage/$1/$2";
/* End of file routes.php */
/* Location: ./application/config/routes.php */
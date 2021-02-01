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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['webtools'] = 'webtools/auth';
$route['webtools/(:any)'] = 'webtools/$1';
$route['webtools/(:any)/(:any)'] = 'webtools/$1/$2';
$route['webtools/(:any)/(:any)/(:any)'] = 'webtools/$1/$2/$3';
$route['webtools/(:any)/(:any)/(:any)/(:any)'] = 'webtools/$1/$2/$3/$4';
$route['webtools/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'webtools/$1/$2/$3/$4/$5';
$route['webtools/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'webtools/$1/$2/$3/$4/$5/$6';

$route['about-us'] = 'home/aboutus';
$route['contact-us'] = 'home/contactus';
$route['([a-zA-z]+)/about-us'] = 'home/aboutus/$1';
$route['([a-zA-z]+)/contact-us'] = 'home/contactus/$1';
$route['what-we-do'] = 'service/index';
$route['what-we-do/(:any)'] = 'service/detail/id/$1';
$route['([a-zA-z]+)/what-we-do'] = 'service/index/$1';
$route['([a-zA-z]+)/what-we-do/(:any)'] = 'service/detail/$1/$2';
$route['portfolio'] = 'portfolio/index';
$route['portfolio/(:any)'] = 'portfolio/index/id/$1';
$route['([a-zA-z]+)/portfolio'] = 'portfolio/index/$1';
$route['([a-zA-z]+)/portfolio/index/(:any)'] = 'portfolio/index/$1/$2';
$route['portfolio/(:any)'] = 'portfolio/detail/$1';
$route['([a-zA-z]+)/portfolio/(:any)'] = 'portfolio/detail/$1/$2';
$route['blog'] = 'blog/index';
$route['blog/index/(:any)'] = 'blog/index/id/$1';
$route['([a-zA-z]+)/blog'] = 'blog/index/$1';
$route['([a-zA-z]+)/blog/index/(:any)'] = 'blog/index/$1/$2';
$route['blog/(:any)'] = 'blog/detail/$1';
$route['([a-zA-z]+)/blog/(:any)'] = 'blog/detail/$1/$2';
$route['job-vacancy'] = 'jobs/index';
$route['job-vacancy/([0-9]+)'] = 'jobs/index/id/$1';
$route['([a-zA-z]+)/job-vacancy'] = 'jobs/index/$1';
$route['([a-zA-z]+)/job-vacancy/([0-9]+)'] = 'jobs/index/$1/$2';
$route['pricing'] = 'pricing/index';
$route['([a-zA-z]+)/pricing'] = 'pricing/index/$1';
$route['([a-zA-z]+)/pricing/detail/(:any)'] = 'pricing/detail/$1/$2';
$route['([a-zA-z]+)/suggestions'] = 'home/suggestions/$1';
$route['([a-zA-z]+)/consultation'] = 'consultation/index/$1';
$route['([a-zA-z]+)'] = 'home/index/$1';



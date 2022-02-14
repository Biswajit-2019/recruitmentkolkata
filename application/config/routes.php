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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'recruitment';
$route['admin/application/(:num)'] = 'admin/application/index/$1';
$route['admin'] = 'admin/home';
$route['admin/hindi'] = 'admin/hindi/home';
$route['panel-samerrr-incal'] ='admin/home';
$route['hindi'] ='hindi/recruitment';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
//$route['panel-samerrr-incal/hindi'] ='admin/hindi/home';


require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->get('cms_pages');
$result = $query->result();
//print_r($result);
foreach( $result as $row )
{
	if($row->id==21){
		$route[$row->slug] = $row->slug;
	}elseif($row->id==42){
		$route[$row->slug] = $row->slug;
	}else{
		$route[$row->slug] = 'cms/'.$row->slug;
	}
	//print_r($row->slug);
   
}

$querynew = $db->get('hindi_cms_pages');
$resultnew = $querynew->result();
//print_r($result);
foreach( $resultnew as $rownew )
{
	//print_r($rownew);
	if($rownew->id==46){
		$route['hindi/'.$rownew->slug] = 'hindi/'.$rownew->slug;
	}elseif($rownew->id==44){
		$route['hindi/'.$rownew->slug] = 'hindi/'.$rownew->slug;	   
	}else{
		$route['hindi/'.$rownew->slug] = 'hindi/cms/'.$rownew->slug;
	}
	
}

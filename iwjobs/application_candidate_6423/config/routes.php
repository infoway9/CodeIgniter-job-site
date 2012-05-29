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

$route['default_controller'] = "indexpg";
$route['index'] = "indexpg/index";


//----- start for user controller --------//

$route['signup'] = "user/signup";
$route['signout'] = "user/signout";
$route['autologin'] = "user/autologin";
$route['activate-account'] = "user/activate_user_account";
$route['forgot-password'] = "user/forgot_password";
$route['reset-password'] = "user/reset_password";

//----- end for user controller --------//



//----- start for private profile -------//

$route['account-setting'] = "profile/account_setting";
$route['personal-profile'] = "profile/personal_profile";
$route['professional-profile']="profile/professional_profile";

//----- end for private profile -------//

//----- start for myaccount ------//

$route['change-password'] = "my_account/change_passowrd";
$route['change-email']="my_account/change_email";

//----- end for myaccount ------//

//----- start job search -------//

$route['job-search']="job_search/index";

//------ end job search --------//

//------ start for ajax ----------//

$route['ajax-fetch-message'] = "ajax/fetch_message";
$route['ajax-check-signup-availability'] = "ajax/check_signup_availability";
$route['ajax-get-key-skill']="ajax/get_key_skill";
//------ end for ajax ----------//


//------ start for static page  ----------//

$route['about-us'] = "staticpg/aboutus";
$route['contact-us'] = "staticpg/contactus";
$route['privacy-policy'] = "staticpg/policy";
$route['terms'] = "staticpg/terms";

//------ end for static page ----------//



$route['404_override'] = 'indexpg/error404';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
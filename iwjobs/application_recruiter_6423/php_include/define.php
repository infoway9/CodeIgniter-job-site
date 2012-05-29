<?php

require_once APPPATH.'php_include/define_page'.EXT;
require_once APPPATH.'php_include/define_table'.EXT;
require_once APPPATH.'php_include/define_api'.EXT;
require_once APPPATH.'php_include/define_ini'.EXT;
require_once APPPATH.'php_include/define_language'.EXT;
//--------- start for path -----------//

define('ABSOLUTE_PATH',$_SERVER['DOCUMENT_ROOT'].'/iwjobs/');
define('UPLOAD_MEDIA_BASEFOLDER',ABSOLUTE_PATH.'upload_media/');
define('SHOW_MEDIA_BASEFOLDER', '../upload_media/');

//--------- end for path -----------//


//------------- START FOR GLOBAL SETTINGS -------------//

define('SUPPORT_EMAIL', 'IwJobs');
define('SUPPORT_NAME', 'support.jobs@infoway.us');
if ( ! defined('DEFAULT_LANGUAGE')) define ( 'DEFAULT_LANGUAGE', $header_language);

//------------- END FOR GLOBAL SETTINGS -------------//

?>
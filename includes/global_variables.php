<?php

global $app;

header('Access-Control-Allow-Origin: *');


$app = array();
if(ENVIRONMENT=='production'){
    error_reporting(E_ALL ^ E_DEPRECATED);
    $FS_PATH = PRODUCTION_INDEX_FILE_PATH;
} else{
    error_reporting(E_ALL);
    $FS_PATH = SANDBOX_INDEX_FILE_PATH;
}

// SET TIMEZONE
date_default_timezone_set(DEFAULT_TIMEZONE);

/* Set Website Filesystem */
if(isset($FS_PATH) && $FS_PATH!=''):
    !defined("FS_PATH") && define("FS_PATH", $_SERVER['DOCUMENT_ROOT'].$FS_PATH);
else:
    !defined("FS_PATH") && define("FS_PATH", $_SERVER['DOCUMENT_ROOT'].'/');
endif;
!defined("FS_PATH_ADMIN") && define("FS_PATH_ADMIN", FS_PATH.ADMIN_FOLDER_NAME.'/');

// add function and classes here
require_once FS_PATH.'includes/constants.php';
require_once DIR_FS_INCLUDES.'database.php';

/* WEBSITE CONSTANTS */
$constants = new query('setting');
$constants->DisplayAll();
while ($constant = $constants->GetObjectFromRecord()):
    // Avoid case-insensitive flag (removed in PHP 8) and skip re-defines
    if (!defined($constant->key)) {
        define($constant->key, html_entity_decode($constant->value));
    }
endwhile;

// add function and classes here (classes first and then function files)
require_once DIR_FS_INCLUDES_CLASSES.'languageClass.php';
require_once DIR_FS_INCLUDES_FUNCTIONS.'common_functions.php';
require_once DIR_FS_INCLUDES_FUNCTIONS.'url_rewrite.php';
require_once DIR_FS_INCLUDES_FUNCTIONS . 'project_related_functions.php';
require_once DIR_FS_INCLUDES_FUNCTIONS . 'badge_places_functions.php';
require_once DIR_FS_INCLUDES_CLASSES.'src/PHPMailer.php'; 
require_once DIR_FS_INCLUDES_FUNCTIONS.'email.php'; 
require_once DIR_FS_INCLUDES_CLASSES.'src/Exception.php';
require_once DIR_FS_INCLUDES_CLASSES.'src/PHPMailer.php';
require_once DIR_FS_INCLUDES_CLASSES.'src/SMTP.php';


if (IS_ECOMMERCE_WEBSITE) {
   require_once DIR_FS_INCLUDES_FUNCTIONS . 'cart_function.php'; 
}
// assign all get variables to $WT_GET
$app['GET'] = filter($_GET);
$_GET = array();

// assign all post variables to $WT_POST
$app['POST'] = filter($_POST);
$_POST = array();

// start - check admin user logged in or not
$logged_in_admin = false;
$logged_in_client_info = array();
if(isset($_SESSION['admin_clientid']) && $_SESSION['admin_clientid']!='' && $_SESSION['admin_clientid']!='0'){
    $query = new query('admin_users');
    $query->Where = "where id = ".$_SESSION['admin_clientid'];
    $logged_in_client_info = $query->DisplayOne();
    if(is_object($logged_in_client_info )){
        $logged_in_admin = true;
    } else{
        unset($_SESSION['admin_clientid']);
    }
}
$app['logged_in_admin'] = $logged_in_admin;
$app['admin_info'] = $logged_in_client_info;
define('LOGGED_IN_ADMIN',$logged_in_admin);
// end - check admin user logged in or not

// start - check front user logged in or not
$logged_in_user = false;
$logged_in_user_info = array();
if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='' && $_SESSION['user_id']!='0'){
    $query = new query('users');
    $query->Where = "where id = ".$_SESSION['user_id'];
    $logged_in_user_info = $query->DisplayOne();
    if(is_object($logged_in_user_info )){
        $logged_in_user = true;
    } else{
        unset($_SESSION['user_id']);
    }
}
$app['logged_in_user'] = $logged_in_user;
$app['user_info'] = $logged_in_user_info;
define('LOGGED_IN_USER',$logged_in_user);
// end - check front user logged in or not

if (IS_ECOMMERCE_WEBSITE) {
    if (isset($_COOKIE["user_key"])) {
        $app['user_key'] = $_COOKIE["user_key"];
    } else {
        $cookie_key = create_random_key(15);
        setcookie('user_key',$cookie_key,time() + (86400 * 30), "/");
        $app['user_key'] = $cookie_key;
    }      
}
define("max_join_size",'18446744073709551615');
define("REDIRECT_QUERY_ADMIN",(trim(str_replace($FS_PATH.ADMIN_FOLDER_NAME.'/','',$_SERVER['REQUEST_URI']),'/')));
define("REDIRECT_QUERY_USER",createRedirectURL($_SERVER['QUERY_STRING']));

//find real max_filesize
$max_filesize = 30 * pow(1024,2); // maximum filesize for this script (x MiB), update post_max_size & upload_max_filesize in php.ini for big size
$max_filesize = min(return_bytes(ini_get('post_max_size')),return_bytes(ini_get('upload_max_filesize')),$max_filesize);
define('MAX_UPLOAD_FILE_SIZE',$max_filesize);
$conf_allowed_file_mime_type = array('application/vnd.ms-excel','text/csv');
$no_direct_access_pages = array('common');
$no_html_pages = array('ajax');
$no_navigation_pages = array('restricted','maintance');

// language code
global $language_code;
$language_code = createGlobalLangaugeCode();
$app['default_language'] = getDefaultLanguageCode();
if (isset($_COOKIE["lang"])) {
    // Normalize language code to lowercase for consistency
    $app['language'] = strtolower(trim($_COOKIE["lang"]));
} else{
    setcookie('lang',$app['default_language'],time()+31556926, "/");
    $app['language'] = $app['default_language'];
}
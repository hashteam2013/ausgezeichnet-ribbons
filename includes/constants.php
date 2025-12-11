<?php
if(ENVIRONMENT=='production'){
    define('DB_HOST',PRODUCTION_DB_HOST);
    define('DB_DATABASE',PRODUCTION_DB_DATABASE);
    define('DB_USER',PRODUCTION_DB_USER);
    define('DB_PASSWORD',PRODUCTION_DB_PASSWORD);
    define('ENABLE_HTTPS',PRODUCTION_ENABLE_HTTPS);
    $WS_PATH = PRODUCTION_SITE_URL;
} else{
    define('DB_HOST',SANDBOX_DB_HOST);
    define('DB_DATABASE',SANDBOX_DB_DATABASE);
    define('DB_USER',SANDBOX_DB_USER);
    define('DB_PASSWORD',SANDBOX_DB_PASSWORD);
    define('ENABLE_HTTPS',SANDBOX_ENABLE_HTTPS);
    $WS_PATH = SANDBOX_SITE_URL;
}
$protocol_prefix = (ENABLE_HTTPS) ? "https://" : "http://";
define('WS_PATH',$protocol_prefix.$WS_PATH);
define('WS_PATH_ADMIN',WS_PATH.ADMIN_FOLDER_NAME.'/');

// custom FS / file paths
define("DIR_FS_CONTROLLER", FS_PATH.'action/');
define("DIR_FS_INCLUDES", FS_PATH.'includes/');
define("DIR_FS_INCLUDES_CLASSES", DIR_FS_INCLUDES.'classes/');
define("DIR_FS_INCLUDES_FUNCTIONS", DIR_FS_INCLUDES.'functions/');
define("DIR_FS_VIEW", FS_PATH.'view/');
define("DIR_FS_VIEW_TEMPLATES", DIR_FS_VIEW.'templates/');
define("DIR_FS_ASSETS", FS_PATH.'assets/');
define("DIR_FS_ASSETS_CSS", DIR_FS_ASSETS.'css/');
define("DIR_FS_ASSETS_JS", DIR_FS_ASSETS.'js/');
define("DIR_FS_ASSETS_IMAGES", DIR_FS_ASSETS.'images/');
define("DIR_FS_UPLOADS", FS_PATH.'uploads/');
define("DIR_FS_LANGUAGES", DIR_FS_ASSETS.'language/');

// custom WS / URL paths
define("DIR_WS_ASSETS", WS_PATH.'assets/');
define("DIR_WS_ASSETS_CSS", DIR_WS_ASSETS.'css/');
define("DIR_WS_ASSETS_JS", DIR_WS_ASSETS.'js/');
define("DIR_WS_ASSETS_IMAGES", DIR_WS_ASSETS.'images/');
define("DIR_WS_UPLOADS", WS_PATH.'uploads/');
define("DIR_WS_ASSETS_PLUGINS", DIR_WS_ASSETS.'plugins/');

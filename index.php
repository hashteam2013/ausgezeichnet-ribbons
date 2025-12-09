<?php

/* SSDN */
/* * ********* INCLUDE FILES *************** */
error_reporting(E_ALL & ~E_WARNING);
ini_set('display_errors', 0);
require_once 'includes/load.php';

/* * ********** FOR URL REWRITE *************** */
//load_url();

/* * *********** website statistic recorded. *********************** */
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "home";

// check site in maintance mode
// if admin logged in then open site even in maintance mode
if (MAINTANCE_MODE):
    $page = 'maintance';
endif;

// check if user ip blocked from admin
$blocked_ips = explode(',', BLACKLIST_IP_ADDRESS);
if (count($blocked_ips) && in_array($_SERVER['REMOTE_ADDR'], $blocked_ips)):
    $page = 'restricted';
endif;

include_once(DIR_FS_CONTROLLER . "common.php");
if (!in_array($page, $no_direct_access_pages)):
    // action files
    if (file_exists(DIR_FS_CONTROLLER . $page . ".php")):
        require_once(DIR_FS_CONTROLLER . $page . ".php");
    else:
        require_once(DIR_FS_CONTROLLER . "404.php");
    endif;
    // html files
    if (!in_array($page, $no_html_pages)):
        include_once (DIR_FS_VIEW_TEMPLATES . 'header.php');
        if (!in_array($page, $no_navigation_pages)):
            include_once (DIR_FS_VIEW_TEMPLATES . 'navigation.php');
        endif;
        if (file_exists(DIR_FS_VIEW . $page . "/index.php")):
            require_once(DIR_FS_VIEW . $page . "/index.php");
        else:
            require_once(DIR_FS_VIEW . "404/index.php");
        endif;
        include_once (DIR_FS_VIEW_TEMPLATES . 'footer.php');
    endif;
else:
    require_once(DIR_FS_CONTROLLER . "404.php");
    require_once(DIR_FS_VIEW . "404/index.php");
endif;
?>

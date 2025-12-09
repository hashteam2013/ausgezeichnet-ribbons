<?php
require_once '../includes/load.php';

// redirect back if user not logged in
if(!(LOGGED_IN_ADMIN)){
    redirect(WS_PATH_ADMIN);
}

$page = isset($app['GET']['page'])?$app['GET']['page']:"dashboard";
$view = isset($app['GET']['view'])?$app['GET']['view']:"list";
$action = isset($app['GET']['action'])?$app['GET']['action']:"list";

// include action file first
if(file_exists(FS_PATH_ADMIN.'action/'.$page.'.php')){
    include_once FS_PATH_ADMIN.'action/'.$page.'.php';
}

// html section starts here
include_once(FS_PATH_ADMIN . 'templates/header.php');
include_once(FS_PATH_ADMIN . 'templates/navigation.php');
if(file_exists(FS_PATH_ADMIN.'view/'.$page.'/'.$view.'.php')){
    include_once FS_PATH_ADMIN.'view/'.$page.'/'.$view.'.php';
} else{
    include_once FS_PATH_ADMIN.'view/404/error.php';
}
include_once(FS_PATH_ADMIN . 'templates/footer.php');
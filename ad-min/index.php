<?php
require_once '../includes/load.php';
if(LOGGED_IN_ADMIN){
    redirect(WS_PATH_ADMIN.'app.php');
} else{
    redirect(WS_PATH_ADMIN.'login.php');
}
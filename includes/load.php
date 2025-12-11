<?php
session_start();

// Ensure verbose error reporting in sandbox to surface issues during form submissions
if (defined('ENVIRONMENT') && ENVIRONMENT === 'sandbox') {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    ini_set('log_errors', '1');
    error_reporting(E_ALL);
}

require_once(__DIR__.'/app.php');
require_once(__DIR__.'/global_variables.php');
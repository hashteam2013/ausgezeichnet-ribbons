<?php
require_once '../includes/load.php';
if (LOGGED_IN_ADMIN) {
    redirect(WS_PATH_ADMIN);
}
$redirect = REDIRECT_QUERY_ADMIN;
$msg = "";
if (isset($app['POST']['username']) != "" && isset($app['POST']['password']) != "") {
    extract($app['POST']);
    if ($username == '') {
        $msg = "username required";
    } elseif ($password == '') {
        $msg = "password required";
    } else {
        $password = generateHash($password);
        $response = check_user_exitance($username, $password);
        if (is_object($response)) {
            if ($response->is_active == '1') {
                set_admin_login($response->id);
                redirect(WS_PATH_ADMIN . $redirect);
            } else {
                $msg = "Your account has been suspended";
            }
        } else {
            $msg = "username / password does not match";
        }
    }
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo SITE_NAME; ?> | Admin Access</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 

        <!--[if lt IE 9]>
        <script src="assets/global/plugins/respond.min.js"></script>
        <script src="assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
    </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="<?php echo app_url(); ?>">
                <img style="max-width: 300px;" src="<?php echo DIR_WS_ASSETS_IMAGES; ?>logo.jpg" alt="logo" class="logo-default" />
            </a>
        </div>
        <!-- END LOGO -->
        <div class="content">
            <h3 class="form-title text-center"><?php echo SITE_NAME; ?> Admin Section</h3>
            <?php if ($msg != '') { ?>
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> <?php echo $msg; ?> </span>
                </div>
            <?php } ?>
            <form id="contact-form" method="post" action="" role="form" class="">
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" value="<?php echo isset($app['POST']['username']) ? $app['POST']['username'] : ""; ?>" type="text" autocomplete="off" placeholder="Username*" name="username" />
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password*" name="password" />
                </div>
                <div class="create-account">
                    <p>
                        <button type="submit" name="login" class="btn btn-info"> Initiate Access </button>
                    </p>
                </div>
            </form>
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="copyright">
            <p class="text-center"> <label class="copy-rt"> &COPY; </label> <?php echo date("Y"); ?> - All rights reserved </p>
        </div>
        <!-- END FOOTER -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
    </body>
</html>
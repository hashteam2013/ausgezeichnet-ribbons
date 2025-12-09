<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo ucwords($page).' | '.SITE_NAME;?></title>
        <?php if ($page == 'home') { ?>
           <meta name="title" content=" <?php echo HOMEPAGE_META_TITLE; ?>"/>	
           <meta name="keywords" content="<?php echo HOMEPAGE_META_KEYWORDS; ?>"/>
           <meta name="description" content="<?php echo HOMEPAGE_META_DESC; ?>"/>
        <?php } ?>
        <!-- Bootstrap -->
        <link href="<?php echo DIR_WS_ASSETS_CSS; ?>bootstrap.css" rel="stylesheet">
        <link href="<?php echo DIR_WS_ASSETS_CSS; ?>style.css" rel="stylesheet">
        <link href="<?php echo DIR_WS_ASSETS_CSS; ?>output.css" rel="stylesheet">
        <link href="<?php echo DIR_WS_ASSETS_CSS; ?>font-awesome.css" rel="stylesheet" type="text/css">
        <link href="<?php echo DIR_WS_ASSETS_PLUGINS; ?>toastr/build/toastr.min.css" rel="stylesheet" type="text/css">
       <?php
       
       if(isset($app['page_specific_css'])):
           foreach($app['page_specific_css'] as $path):
               echo '<link href="'.$path.'" rel="stylesheet" type="text/css">';
           endforeach;
       endif;
       ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?= DIR_WS_ASSETS_JS; ?>bootstrap.min.js"></script>
    </head>
    <body>
        <div class="ajax-load-image" style="display:none;"><img src="/assets/images/ajax.svg"></div>
        <header class="header-top">
            <input type="hidden" id="WS_PATH" value="<?php echo WS_PATH;?>"/>
            <input type="hidden" id="LOGGED_IN_USER" value="<?php echo LOGGED_IN_USER;?>"/>
            <div class="container">
                <div class="row"> 
                    <!-- Logo Start -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="logo-outer"><a href="<?php echo WS_PATH; ?>index.php"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>logo.jpg" class="img-responsive"> </a> </div>
                    </div>
                    <!-- Logo end--> 

                    <!-- Search Start -->
                    <div class="col-md-4 col-sm-5"></div>
                    <!-- Search End --> 
                  <?php //$app['user_info']->id; ?>
                    <!-- login Section Start -->
                    <div class="col-md-4 col-sm-7 col-xs-12">
                        <div class="login-outer" >
                            <ul class="flag-top">
                                <?php foreach($activeLangauges as $langauge_item){
                                    $language_switch_link = ($langauge_item->code == $app['language']) ? "javascript:void()" : make_url('switch_langauge',array('code'=>$langauge_item->code, 'redirect'=> REDIRECT_QUERY_USER ));
                                    ?>
                                    <li> <a href="<?php echo $language_switch_link;?>" title="<?php echo $langauge_item->name;?>"><img src="<?php echo DIR_WS_ASSETS_IMAGES.$langauge_item->code.'.png'; ?>"> </a> </li>
                                <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                            <?php if (!in_array($page, $no_navigation_pages)): ?>
                            <ul class="login-top">
                               <?php if (isset($_SESSION['user_id'])) { ?>
                               <?php //pr($logged_in_user_info->first_name);?>
                                    <li><a href="<?php echo make_url("profile");?>" title=""> <?php _e("HEllO") ?> <?php echo strtoupper(html_entity_decode($logged_in_user_info->first_name . ' ' . $logged_in_user_info->last_name)); ?></a></li>
                                   <li><a href="<?php echo make_url("logout"); ?>"> <?php _e("Logout");?></a> </li>
                               <?php } else { ?>
                                   <li><a href="#" data-toggle="modal" data-target="#myModal" id="login-link" title="<?php _e("Login");?>"> <?php _e("Login");?> </a> </li>
                                   <li><a href="#"  data-toggle="modal" data-target="#myModal" id="register-link"> <?php _e("Register");?> </a> </li>
                               <?php } ?>
                           </ul>
                           <?php endif; ?>
                        </div>
                    </div>
                    <!-- Login Section End --> 
                </div>
            </div>
        </header>

        <!-- Navbar  start -->

        




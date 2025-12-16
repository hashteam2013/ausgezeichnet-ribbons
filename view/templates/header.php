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
        <!--<link href="<?php echo DIR_WS_ASSETS_CSS; ?>bootstrap.css" rel="stylesheet">-->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

        <link href="<?php echo DIR_WS_ASSETS_CSS; ?>style.css" rel="stylesheet">
        <link href="<?php echo DIR_WS_ASSETS_CSS; ?>output.css" rel="stylesheet">
        <link href="<?php echo DIR_WS_ASSETS_CSS; ?>font-awesome.css" rel="stylesheet" type="text/css">
        <link href="<?php echo DIR_WS_ASSETS_PLUGINS; ?>toastr/build/toastr.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
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
    <body class="">
        <div class="ajax-load-image" style="display:none;"><img src="/assets/images/ajax.svg"></div>
        <header class="header-top py-5 bg-white">
            <input type="hidden" id="WS_PATH" value="<?php echo WS_PATH;?>"/>
            <input type="hidden" id="LOGGED_IN_USER" value="<?php echo LOGGED_IN_USER;?>"/>
            <div class="container-custom">
                <div class="flex gap-5 items-center justify-between"> 
                    <!-- Logo Start -->
                    <div class="logo-outer flex lg:w-[27%] w-[30%]">
                        <a href="<?php echo WS_PATH; ?>index.php" class="w-[285px] inline-block"> 
                            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>logo.jpg" class="w-full">
                        </a> 
                    </div>
                    <!-- Logo end--> 
                        <!-- Brand and toggle get grouped for better mobile display 
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        </div>-->

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="w-[46%] lg:block hidden">
                            <ul class="main-nav-bar lg:flex-nowrap flex-wrap flex items-center gap-7 justify-center w-full">
                                <?php
                                if ($page!='home') {
                                    ?>
                                    <li><a class="text-base font-medium text-secondary hover:text-primary" href="<?php echo make_url("home"); ?>index.php"><?php _e('Home');?></a></li>
                                    <li><a class="text-base font-medium text-secondary hover:text-primary" href="<?php echo make_url("home"); ?>#welcome"><?php _e('Welcome');?></a></li>
                                    <li><a class="text-base font-medium text-secondary hover:text-primary" href="<?php echo make_url("shop"); ?>"><?php _e('Shop');?></a></li>
                                    <li><a class="text-base font-medium text-secondary hover:text-primary" href="<?php echo make_url("home"); ?>#about-us"><?php _e('About Us');?></a></li>
                                    <li><a class="text-base font-medium text-secondary hover:text-primary" href="<?php echo make_url("home"); ?>#contact"><?php _e('Contact');?></a></li>
                                <?php } else { ?>
                                    <li class="active">
                                        <a class="text-base font-medium text-secondary hover:text-primary" href="<?php echo make_url("home"); ?>index.php"><?php _e('Home');?><span class="sr-only">(current)</span>
                                        </a>
                                    </li>
                                    <li><a class="myrefclass text-base font-medium text-secondary hover:text-primary" href="#welcome"><?php _e('Welcome');?></a></li>
                                    <li><a class="myrefclass text-base font-medium text-secondary hover:text-primary" href="<?php echo make_url("shop"); ?>"><?php _e('Shop');?></a></li>
                                    <li><a class="myrefclass text-base font-medium text-secondary hover:text-primary" href="#about-us" ><?php _e('About Us');?></a></li>
                                    <li><a class="myrefclass text-base font-medium text-secondary hover:text-primary" href="#contact"><?php _e('Contact');?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse --> 
                    


                    
                  <?php //$app['user_info']->id; ?>
                    <!-- login Section Start -->
                        <div class="login-outer flex xl:flex-nowrap flex-wrap items-center justify-end lg:w-[27%] w-[40%] gap-5" >
                            <?php if (!in_array($page, $no_navigation_pages)): ?>
                            <ul class="login-top flex gap-2.5">
                               <?php if (isset($_SESSION['user_id'])) { ?>
                               <?php //pr($logged_in_user_info->first_name);?>
                                    <li><a href="<?php echo make_url("profile");?>" title=""> <?php _e("HEllO") ?> <?php echo strtoupper(html_entity_decode($logged_in_user_info->first_name . ' ' . $logged_in_user_info->last_name)); ?></a></li>
                                   <li><a href="<?php echo make_url("logout"); ?>"> <?php _e("Logout");?></a> </li>
                               <?php } else { ?>
                                   <li><a href="#" class="bg-secondary px-5 inline-flex items-center justify-center text-white rounded-xl font-semibold text-base min-h-12" id="login-link" title="<?php _e("Login");?>"> <?php _e("Login");?> </a> </li>
                                   <li><a href="#" class="bg-primary px-5 inline-flex items-center justify-center text-white rounded-xl font-semibold text-base min-h-12"   id="register-link"> <?php _e("Register");?> </a> </li>
                               <?php } ?>
                           </ul>
                           <?php endif; ?>
                            <ul class="flag-top flex gap-1.5">
                                <?php foreach($activeLangauges as $langauge_item){
                                    $language_switch_link = ($langauge_item->code == $app['language']) ? "javascript:void()" : make_url('switch_langauge',array('code'=>$langauge_item->code, 'redirect'=> REDIRECT_QUERY_USER ));
                                    ?>
                                    <li> <a href="<?php echo $language_switch_link;?>" title="<?php echo $langauge_item->name;?>"><img src="<?php echo DIR_WS_ASSETS_IMAGES.$langauge_item->code.'.png'; ?>"> </a> </li>
                                <?php } ?>
                            </ul>
                        </div>
                   
                    <!-- Login Section End --> 
                </div>
            </div>
        </header>

        <!-- Navbar  start -->

        




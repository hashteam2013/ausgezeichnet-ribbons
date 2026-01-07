<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
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
    <?php
        // Normalize language code to avoid case-sensitivity issues (e.g. "DE" vs "de")
        $currentLang = isset($app['language']) ? strtolower($app['language']) : '';
        // Treat English explicitly; everything else (e.g. "dr" for German) uses the German body class
        $bodyClass = ($currentLang === 'en') ? 'english' : 'german-active';
    ?>
    <body class="<?php echo $bodyClass; ?> testing-body">
        <div class="ajax-load-image" style="display:none;"><img src="/assets/images/ajax.svg"></div>
        <header class="header-top lg:py-5 py-2 bg-white relative">
            <input type="hidden" id="WS_PATH" value="<?php echo WS_PATH;?>"/>
            <input type="hidden" id="LOGGED_IN_USER" value="<?php echo LOGGED_IN_USER;?>"/>
            <div class="container-custom">
                <div class="flex lg:gap-5 gap-2 items-center justify-between"> 
                    <!-- Logo Start -->
                    <div class="logo-outer flex 2xl:w-[30%] xl:w-[32%] lg:w-[27%] w-[69%]">
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
                        <div id="navmenus" class="2xl:w-[40%] xl:w-[36%] lg:block hidden lg:relative lg:top-0 top-full lg:w-auto w-full absolute left-0 lg:bg-transparent bg-secondary lg:z-[0] z-[1]">
                            <ul class="main-nav-bar lg:flex-nowrap flex-wrap flex lg:flex-row lg:p-0 px-5 py-5 flex-col lg:items-center xl:gap-7 gap-4 justify-center w-full">
                                <?php
                                if ($page!='home') {
                                    ?>
                                    <li><a class="xl:text-base text-sm font-medium lg:text-secondary text-white hover:text-primary" href="<?php echo make_url("home"); ?>index.php"><?php _e('Home');?></a></li>
                                    <li><a class="xl:text-base text-sm font-medium lg:text-secondary text-white hover:text-primary" href="<?php echo make_url("home"); ?>#shop-ribbon"><?php _e('Welcome');?></a></li>
                                    <li><a class="xl:text-base text-sm font-medium lg:text-secondary text-white hover:text-primary" href="<?php echo make_url("shop"); ?>"><?php _e('Shop');?></a></li>
                                    <li><a class="xl:text-base text-sm xl:whitespace-normal whitespace-nowrap font-medium lg:text-secondary text-white hover:text-primary" href="<?php echo make_url("home"); ?>#welcome"><?php _e('About Us');?></a></li>
                                    <li><a class="xl:text-base text-sm font-medium lg:text-secondary text-white hover:text-primary" href="<?php echo make_url("home"); ?>#contact"><?php _e('Contact');?></a></li>
                                    <li class="lg:hidden flex">
                                        <?php if (!in_array($page, $no_navigation_pages)): ?>
                                            <ul class="login-top flex gap-2.5">
                                            <?php if (isset($_SESSION['user_id'])) { ?>
                                            <?php //pr($logged_in_user_info->first_name);?>
                                                     
                                                <div class="hidden"><li><a href="<?php echo make_url("profile");?>" title=""> <?php _e("HEllO") ?> <?php echo strtoupper(html_entity_decode($logged_in_user_info->first_name . ' ' . $logged_in_user_info->last_name)); ?></a></li>
                                                <li><a href="<?php echo make_url("logout"); ?>"> <?php _e("Logout");?></a> </li>
                                                </div>

                                            <?php } else { ?>
                                                <li class="inline-flex">
                                                    <a href="#" class="bg-secondary border border-white px-4 py-1 text-white rounded-md font-semibold  text-sm min-h-[34px]" id="login-link" title="<?php _e("Login");?>"> <?php _e("Login");?>
                                                </span> 
                                                    </a> 
                                                </li>
                                                <li class="inline-flex">
                                                    <a href="#" class="bg-primary border-2 border-transparent px-4 py-1 text-white rounded-md font-semibold  text-sm min-h-[34px]"   id="register-link"> 
                                                    <?php _e("Register");?>
                                                    </a> 
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php } else { ?>
                                    <li class="active">
                                        <a class="xl:text-base text-sm font-medium lg:text-secondary text-white hover:text-primary" href="<?php echo make_url("home"); ?>index.php"><?php _e('Home');?><span class="sr-only">(current)</span>
                                        </a>
                                    </li>
                                    <li><a class="myrefclass xl:text-base text-sm font-medium lg:text-secondary text-white hover:text-primary" href="#shop-ribbon"><?php _e('Welcome');?></a></li>
                                    <li><a class="myrefclass xl:text-base text-sm font-medium lg:text-secondary text-white hover:text-primary" href="<?php echo make_url("shop"); ?>"><?php _e('Shop');?></a></li>
                                    <li><a class="myrefclass xl:whitespace-normal whitespace-nowrap xl:text-base text-sm font-medium lg:text-secondary text-white hover:text-primary" href="#welcome" ><?php _e('About Us');?></a></li>
                                    <li><a class="myrefclass xl:text-base text-sm font-medium lg:text-secondary text-white hover:text-primary" href="#contact"><?php _e('Contact');?></a></li>
                                    <li class="lg:hidden flex">
                                        <?php if (!in_array($page, $no_navigation_pages)): ?>
                                            <ul class="login-top flex gap-2.5">
                                            <?php if (isset($_SESSION['user_id'])) { ?>
                                            <?php //pr($logged_in_user_info->first_name);?>
                                                    <div class="hidden">
                                                    <li><a href="<?php echo make_url("profile");?>" title=""> <?php _e("HEllO") ?> <?php echo strtoupper(html_entity_decode($logged_in_user_info->first_name . ' ' . $logged_in_user_info->last_name)); ?></a></li>
                                                <li><a href="<?php echo make_url("logout"); ?>"> <?php _e("Logout");?></a> </li>
                                                    </div>
                                            <?php } else { ?>
                                                <li class="inline-flex">
                                                    <a href="#" class="bg-secondary border border-white px-4 py-1 text-white rounded-md font-semibold  text-sm min-h-[34px]" id="login-link" title="<?php _e("Login");?>"> <?php _e("Login");?>
                                                </span> 
                                                    </a> 
                                                </li>
                                                <li class="inline-flex">
                                                    <a href="#" class="bg-primary border-2 border-transparent px-4 py-1 text-white rounded-md font-semibold  text-sm min-h-[34px]"   id="register-link"> 
                                                    <?php _e("Register");?>
                                                    </a> 
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse --> 
                    


                    
                  <?php //$app['user_info']->id; ?>
                    <!-- login Section Start -->
                        <div class="login-outer flex xl:flex-nowrap flex-wrap items-center justify-end 2xl:w-[30%] xl:w-[32%] lg:w-[40%] w-[31%] 2xl:gap-5 gap-3 lg:pe-0 pe-7">
                            <?php if (!in_array($page, $no_navigation_pages)): ?>
                            <ul class="login-top lg:flex hidden gap-2.5">
                               <?php if (isset($_SESSION['user_id'])) { ?>
                               <?php //pr($logged_in_user_info->first_name);?>
                                    <li><a href="<?php echo make_url("profile");?>" title="" class="inline-flex rounded-full items-center justify-center w-10 h-10 bg-primary/10">  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 17.5V15.8333C16.6667 14.9493 16.3155 14.1014 15.6904 13.4763C15.0653 12.8512 14.2174 12.5 13.3334 12.5H6.66671C5.78265 12.5 4.93481 12.8512 4.30968 13.4763C3.68456 14.1014 3.33337 14.9493 3.33337 15.8333V17.5M13.3334 5.83333C13.3334 7.67428 11.841 9.16667 10 9.16667C8.15909 9.16667 6.66671 7.67428 6.66671 5.83333C6.66671 3.99238 8.15909 2.5 10 2.5C11.841 2.5 13.3334 3.99238 13.3334 5.83333Z" stroke="#ED0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        </a>
                                    </li>
                                   <li><a href="<?php echo make_url("logout"); ?>" class="inline-flex rounded-full items-center justify-center w-10 h-10 bg-primary/10"> <svg class="fill-primary" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20" height="20" viewBox="0 0 89.149 122.88" enable-background="new 0 0 89.149 122.88" xml:space="preserve"><g><path d="M79.128,64.598H40.069c-1.726,0-3.125-1.414-3.125-3.157c0-1.744,1.399-3.158,3.125-3.158h39.057L66.422,43.733 c-1.14-1.301-1.019-3.289,0.269-4.439c1.288-1.151,3.257-1.03,4.396,0.271l17.281,19.792c1.061,1.211,1.029,3.019-0.02,4.19 l-17.262,19.77c-1.14,1.302-3.108,1.423-4.396,0.271c-1.287-1.151-1.408-3.139-0.269-4.44L79.128,64.598L79.128,64.598z M42.396,116.674c1.689,0.409,2.727,2.11,2.318,3.799c-0.409,1.689-2.109,2.728-3.799,2.318c-3.801-0.922-7.582-1.671-11.052-2.358 C10.426,116.583,0,114.519,0,86.871V34.188C0,7.96,11.08,5.889,29.431,2.46c3.572-0.667,7.448-1.391,11.484-2.371 c1.689-0.409,3.39,0.629,3.799,2.319c0.408,1.689-0.629,3.39-2.318,3.799c-4.291,1.041-8.201,1.771-11.805,2.445 C15.454,11.48,6.315,13.188,6.315,34.188v52.683c0,22.467,8.643,24.179,24.756,27.37C34.453,114.911,38.138,115.642,42.396,116.674 L42.396,116.674z"/></g></svg></a> </li>
                               <?php } else { ?>
                                   <li>
                                    <a href="#" class="bg-secondary 2xl:px-5 lg:px-4 lg:w-auto lg:h-auto w-10 h-10 inline-flex items-center justify-center text-white lg:rounded-xl rounded-md font-semibold 2xl:text-base text-sm lg:min-h-12" id="login-link" title="<?php _e("Login");?>"> <span class=""><?php _e("Login");?></span>
                                   </span> 
                                    </a> 
                                   </li>
                                   <li>
                                    <a href="#" class="bg-primary 2xl:px-5 lg:px-4  lg:w-auto lg:h-auto w-10 h-10 inline-flex items-center justify-center text-white lg:rounded-xl rounded-md font-semibold 2xl:text-base text-sm lg:min-h-12"   id="register-link"> 
                                    <span class=""><?php _e("Register");?></span>
                                    </a> 
                                    </li>
                               <?php } ?>
                           </ul>
                           <?php endif; ?>
                            <ul class="flag-top flex gap-1.5">
                                <?php foreach($activeLangauges as $langauge_item){
                                    $language_switch_link = ($langauge_item->code == $app['language']) ? "javascript:void()" : make_url('switch_langauge',array('code'=>$langauge_item->code, 'redirect'=> REDIRECT_QUERY_USER ));
                                    ?>
                                    <li> <a href="<?php echo $language_switch_link;?>" title="<?php echo $langauge_item->name;?>"><img src="<?php echo DIR_WS_ASSETS_IMAGES.$langauge_item->code.'.png'; ?>" class="lg:w-auto w-7"> </a> </li>
                                <?php } ?>
                            </ul>
                            <ul class="lg:hidden flex gap-1">
                                <?php if (isset($_SESSION['user_id'])) { ?>
                               <?php //pr($logged_in_user_info->first_name);?>
                                    <li><a href="<?php echo make_url("profile");?>" title="" class="inline-flex rounded-full items-center justify-center w-7 h-7 bg-primary/10">  <svg width="12" height="12" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 17.5V15.8333C16.6667 14.9493 16.3155 14.1014 15.6904 13.4763C15.0653 12.8512 14.2174 12.5 13.3334 12.5H6.66671C5.78265 12.5 4.93481 12.8512 4.30968 13.4763C3.68456 14.1014 3.33337 14.9493 3.33337 15.8333V17.5M13.3334 5.83333C13.3334 7.67428 11.841 9.16667 10 9.16667C8.15909 9.16667 6.66671 7.67428 6.66671 5.83333C6.66671 3.99238 8.15909 2.5 10 2.5C11.841 2.5 13.3334 3.99238 13.3334 5.83333Z" stroke="#ED0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        </a>
                                    </li>
                                   <li><a href="<?php echo make_url("logout"); ?>" class="inline-flex rounded-full items-center justify-center w-7 h-7  bg-primary/10"> <svg class="fill-primary" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="12" height="12" viewBox="0 0 89.149 122.88" enable-background="new 0 0 89.149 122.88" xml:space="preserve"><g><path d="M79.128,64.598H40.069c-1.726,0-3.125-1.414-3.125-3.157c0-1.744,1.399-3.158,3.125-3.158h39.057L66.422,43.733 c-1.14-1.301-1.019-3.289,0.269-4.439c1.288-1.151,3.257-1.03,4.396,0.271l17.281,19.792c1.061,1.211,1.029,3.019-0.02,4.19 l-17.262,19.77c-1.14,1.302-3.108,1.423-4.396,0.271c-1.287-1.151-1.408-3.139-0.269-4.44L79.128,64.598L79.128,64.598z M42.396,116.674c1.689,0.409,2.727,2.11,2.318,3.799c-0.409,1.689-2.109,2.728-3.799,2.318c-3.801-0.922-7.582-1.671-11.052-2.358 C10.426,116.583,0,114.519,0,86.871V34.188C0,7.96,11.08,5.889,29.431,2.46c3.572-0.667,7.448-1.391,11.484-2.371 c1.689-0.409,3.39,0.629,3.799,2.319c0.408,1.689-0.629,3.39-2.318,3.799c-4.291,1.041-8.201,1.771-11.805,2.445 C15.454,11.48,6.315,13.188,6.315,34.188v52.683c0,22.467,8.643,24.179,24.756,27.37C34.453,114.911,38.138,115.642,42.396,116.674 L42.396,116.674z"/></g></svg></a> </li>
                               <?php }?>
                            </ul>
                        </div>

                        <div class="absolute right-4  lg:hidden block">
                            <button type="button" id="menutoggle">
                              <svg width="20" height="20" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5 6H10.5M1.5 3H10.5M1.5 9H10.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                            </button>
                        </div>
                   
                    <!-- Login Section End --> 
                </div>
            </div>
        </header>

        <!-- Navbar  start -->

        




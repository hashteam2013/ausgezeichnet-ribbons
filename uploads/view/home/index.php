
<!--<a href="<?php //echo make_url(); ?>">Homepage URL</a><br/>
<a href="<?php //echo make_url('login'); ?>">login</a><br/>
<a href="<?php //echo make_url('product',array('id'=>2)); ?>">product</a><br/>-->

<!-- slider section start -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <section class="crousal-outer">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-pause="hover"> 
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active" > <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>slide-1.jpg" class="img-responsive" alt="...">
                            <div class="carousel-caption"> ... </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>slide-2.jpg" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>slide-3.jpg" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                    </div>

                    <!-- Controls --> 
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only"><?php _e("Previous"); ?></span> </a> <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only"><?php _e('Next'); ?></span> </a> </div>
            </section>
        </div>
    </div>
</div>
<!-- slider section End --> 

<!-- About section start -->
<section class="about-sec text-center" id="welcome" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php _e("Welcome content"); ?>
                <!--        <a href="#">Read More</a>-->
            </div>
        </div>
    </div>
</section>
<!-- About section end --> 

<!-- Shop Ribbons start -->
<section class="shop-ribbons" id="shop-ribbon">
     <?php _e("products"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="red-main-hd"><?php //_e('Shop Ribbons'); ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="shop-inner-sec">
                    <div class="shop-img"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>shop-1.jpg" class="img-responsive"> </div>
                    <h4><?php _e('medals'); ?></h4>
                    <?php _e('original content') ?>
                    <a href="<?php echo make_url('home'); ?>#contact" class="hvr-float-shadow"><?php _e('contact us'); ?> </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="shop-inner-sec">
                    <div class="shop-img"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>shop-2.jpg" class="img-responsive"> </div>
                    <h4><?php _e('miniatures'); ?></h4>
                    <?php _e('miniatures content'); ?>
                    <a href="<?php echo make_url('home'); ?>#contact" class="hvr-float-shadow" ><?php _e('contact us'); ?> </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="shop-inner-sec">
                    <div class="shop-img"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>shop-3.jpg" class="img-responsive"> </div>
                    <h4><?php _e('modular ribbons'); ?></h4>
                    <?php _e('ribbons content'); ?>
                    <a href="<?php echo make_url('home'); ?>#products" class="hvr-float-shadow"><?php _e("more info"); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="text-center">
    <a href="<?php echo make_url('shop'); ?>" class="all-cat add-btn hvr-float-shadow"><font><?php _e("View all categories"); ?></font><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a>
</div>

<section class="hand-band" id="products">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
  
                <?php _e('Below shop content'); ?>
                   

            <section class="crousal-outer">
                <div id="carousel-2" class="carousel slide" data-ride="carousel" data-pause="hover"> 
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-2" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-2" data-slide-to="1"></li>
                        <li data-target="#carousel-2" data-slide-to="2"></li>
                        <li data-target="#carousel-2" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active" > <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>slider2_1.jpg" class="img-responsive" alt="...">
                            <div class="carousel-caption"> ... </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>slider2_2.jpg" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>slider2_3.jpg" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>slider2_4.jpg" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                    </div>

                    <!-- Controls --> 
                    <a class="left carousel-control" href="#carousel-2" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only"><?php _e("Previous"); ?></span> </a> <a class="right carousel-control" href="#carousel-2" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only"><?php _e('Next'); ?></span> </a> </div>
            </section>

            <section class="crousal-outer" style="margin-top:20px;">
                <div id="carousel-3" class="carousel slide" data-ride="carousel" data-pause="hover"> 
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
   <!--                     <li data-target="#carousel-3" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-3" data-slide-to="1"></li>
                        <li data-target="#carousel-3" data-slide-to="2"></li>
                        <li data-target="#carousel-3" data-slide-to="3"></li>
                        <li data-target="#carousel-3" data-slide-to="4"></li>
                        <li data-target="#carousel-3" data-slide-to="5"></li>
                        <li data-target="#carousel-3" data-slide-to="6"></li>
                        <li data-target="#carousel-3" data-slide-to="7"></li>
                        <li data-target="#carousel-3" data-slide-to="8"></li>
                        <li data-target="#carousel-3" data-slide-to="9"></li>
                        <li data-target="#carousel-3" data-slide-to="10"></li>
                        <li data-target="#carousel-3" data-slide-to="11"></li>
                        <li data-target="#carousel-3" data-slide-to="12"></li>
                        <li data-target="#carousel-3" data-slide-to="13"></li>
                        <li data-target="#carousel-3" data-slide-to="14"></li>
                        <li data-target="#carousel-3" data-slide-to="15"></li>
                        <li data-target="#carousel-3" data-slide-to="16"></li>
                        <li data-target="#carousel-3" data-slide-to="17"></li> -->
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active" > <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>1f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> ... </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>2f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>3f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>4f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>5f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>6f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>7f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>8f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>9f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>10f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>11f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>12f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>13f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>14f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>15f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>16f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>17f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                        <div class="item"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>18f.png" class="img-responsive" alt="...">
                            <div class="carousel-caption"> </div>
                        </div>
                    </div>

                    <!-- Controls --> 
                    <a class="left carousel-control" href="#carousel-3" role="button" data-slide="prev" style="background-image:none !important;"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only"><?php _e("Previous"); ?></span> </a> <a class="right carousel-control" href="#carousel-3" role="button" data-slide="next"  style="background-image:none !important;"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only"><?php _e('Next'); ?></span> </a> </div>
            </section>


                <div class="iframe_call"><?php _e('montagevideo'); ?></div>

                <?php _e('miniatures content2'); ?>


	<img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>Miniatur_collection.jpg" class="img-responsive">
                <?php _e('Below shop content3'); ?>
	<img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>Konfigurator.jpg" class="img-responsive konfigurator">
                <?php _e('Below shop content4'); ?>
            </div>


        </div>
    </div>
</section>	

<section class="about-us" id="about-us">
    <div class="container">
        <div class="row">
            <h1><?php _e("About Us"); ?></h1>
            <div class="col-sm-6">
                <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>img-crcl.png" class="img-responsive img-circle">
                <?php _e('about us content left');?>
            </div>
            <div class="col-sm-6">
                <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>img-crcl1.png" class="img-responsive img-circle">
                <?php _e('about us content right'); ?>
            </div>
        </div>
    </div>
</section>
<section class="cont-us" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1><?php _e('Contact Us'); ?></h1>
                <h3><?php _e('Excellent. Cc  | Full-Modular Order Orders'); ?></h3>
            </div>
            <div class="col-sm-6">
                <h2><?php _e('generalquestions'); ?></h2>
                <?php _e('generalquestionscontact');?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h2><?php _e('Management Engineering');?></h2>
                <?php _e('Management Engineering content');?>
            </div>
            <div class="col-sm-6">
                <h2><?php _e('Management Marketing & Sales');?></h2>
                <?php _e('Management Marketing & Sales content'); ?>
            </div>
        </div>
    </div>
</section>



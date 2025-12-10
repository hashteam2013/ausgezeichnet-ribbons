
<!--<a href="<?php //echo make_url(); ?>">Homepage URL</a><br/>
<a href="<?php //echo make_url('login'); ?>">login</a><br/>
<a href="<?php //echo make_url('product',array('id'=>2)); ?>">product</a><br/>-->

<!-- Banner section start -->
<section class="banner relative">
    <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>banner.jpg" class="w-full h-full">
    <div class="absolute bg-black/60 top-0 left-0 w-full h-full flex items-center justify-center">
        <div class="container-custom">
            <div class="text-center text-white">
                <h3 class="mb-2 text-[40px] leading-[50px] tracking-[0.4px] font-semibold text-white">Ausgezeichnet.cc</h3>
                <h1 class="text-8xl font-gothic leading-[120px] font-normal">
                    Crafting Excellence, Delivered Simply.
                </h1>
            </div>
            <ul class="flex text-white items-center gap-2.5 flex-wrap text-2xl font-medium mt-10 justify-center mx-auto max-w-[1120px]">
                <li class="py-2">Modular by Design</li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2">Engineered for Comfort</li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2">Honest & Upfront</li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2">Swift & Secure </li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2">Effortless</li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2">Logistics</li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2">Guaranteed Supply</li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2">Personalized Experience</li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2">Austrian Craftsmanship</li>
            </ul>
        </div>
    </div>
</section>

<!-- Banner section End --> 

<!-- About section start -->
<section class="py-24" id="welcome" >
    <div class="container-custom">
        <?php _e("Welcome content"); ?>
        <div class="flex gap-14 mb-10">
            <div class="w-1/2">
                <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>about.png" class="w-full rounded-[20px]">
            </div>
            <div class="w-1/2 flex flex-col gap-5">
                <h5 class="uppercase text-xl text-dark font-semibold">ABOUT US</h5>
                <h2 class="capitalize text-primary text-6xl leading-[80px] font-gothic font-normal">Crafting Excellence, Honoring Service</h2>
                <p class="text-xl leading-[50px] text-dark font-normal">At Ausgezeichnet.cc, we believe that service and achievement deserve to be honored with precision and distinction. We specialize in crafting and assembling fully modular medal clasps (Ordensspangen), providing the highest standard for presenting your military, police, and official service decorations.</p>
            </div>
        </div>
        <div class="flex flex-col">
            <p class="text-xl leading-[50px] text-dark font-normal">The name "Ausgezeichnet" is German for "excellent" or "distinguished," a principle that guides every ribbon bar we produce. We understand the significance of your honors. Our innovative, fully modular system ensures that every decoration, device, and ribbon is displayed with perfect accuracy and alignment, reflecting the exact order and criteria of your awards.</p>
        </div>
    </div>
</section>
<!-- About section end --> 

<!-- Shop Ribbons start -->
<section class="shop-ribbons py-24" id="shop-ribbon">
    <div class="container-custom">
        <div class="flex flex-col ">
            <h2 class="red-main-hd"><?php _e("products"); ?></h2>
            <h2 class="capitalize mt-4 text-primary text-6xl leading-[80px] font-gothic font-normal">Explore Our Products</h2>
        </div>
        
        <div class="flex mt-14 gap-12">
            <div class="w-1/3">
                <div class="bg-body h-full rounded-[20px] flex flex-col">
                    <div class="w-full"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>shop-1.jpg" class="w-full rounded-tr-[20px] rounded-tl-[20px]"> </div>
                    <div class="p-10 flex flex-col items-start flex-auto">
                        <h4 class="text-secondary max-w-xs capitalize text-3xl font-gothic font-normal mb-5"><?php _e('medals'); ?></h4>
                        <div class="text-base leading-[30px] text-dark font-normal mb-10"><?php _e('original content') ?></div>
                        <a href="<?php echo make_url('home'); ?>#contact" class="capitalize mt-auto inline-flex bg-primary text-white min-h-12 px-5 rounded-xl items-center justify-center text-base font-semibold"><?php _e('contact us'); ?> </a>
                    </div>
                    
                </div>
            </div>
            <div class="w-1/3">
                <div class="bg-body h-full rounded-[20px] flex flex-col">
                    <div class="w-full"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>shop-2.jpg" class="w-full rounded-tr-[20px] rounded-tl-[20px]"> </div>
                    <div class="p-10 flex flex-col items-start flex-auto">
                        <h4 class="text-secondary max-w-xs capitalize text-3xl font-gothic font-normal mb-5"><?php _e('miniatures'); ?></h4>
                        <div class="text-base leading-[30px] text-dark font-normal mb-10"><?php _e('miniatures content'); ?></div>
                        <a href="<?php echo make_url('shop'); ?>#products" class="inline-flex mt-auto bg-primary text-white min-h-12 px-5 rounded-xl capitalize items-center justify-center text-base font-semibold"><?php _e("View all categories"); ?></a>
                    </div>
                </div>
            </div>
            <div class="w-1/3">
                <div class="bg-body h-full rounded-[20px] flex flex-col">
                    <div class="w-full"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>shop-3.jpg" class="w-full rounded-tr-[20px] rounded-tl-[20px]"> </div>
                    <div class="p-10 flex flex-col items-start flex-auto">
                        <h4 class="text-secondary max-w-xs capitalize text-3xl font-gothic font-normal mb-5"><?php _e('modular ribbons'); ?></h4>
                        <div class="text-base leading-[30px] text-dark font-normal mb-10"><?php _e('ribbons content'); ?></div>
                        <a href="<?php echo make_url('home'); ?>#products" class="mt-auto capitalize inline-flex bg-primary text-white min-h-12 px-5 rounded-xl items-center justify-center text-base font-semibold"><?php _e("more info"); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="text-center relative">
    <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>shop.jpg" class="w-full">
    <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center  bg-black/70">
        <div class="container-custom">
            <div class="flex flex-col items-center justify-center max-w-[1060px] mx-auto gap-5">
                <h2 class="text-white font-gothic font-normal text-6xl max-w-[700px] mx-auto leading-[75px]">Ausgezeichnet.cc: Modular German Ribbon Bars</h2>
                <p class="text-[#E5E6E8] text-xl font-normal leading-[35px]">We produce the missing ribbons and miniatures needed to wear Austrian awards on German ribbon bars. We closed this long-standing gap in the market!</p>
                <a href="<?php echo make_url('shop'); ?>" class="text-white bg-primary text-base font-semibold px-7 inline-flex items-center justify-center rounded-xl min-h-12"><font><?php _e("Shop Now"); ?></font></a>
            </div>
        </div>
    </div>
</section>

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

<section class="py-24" id="about-us">
    <div class="container-custom">
        <h5 class="text-dark text-xl font-semibold uppercase mb-5"><?php _e("About Us"); ?></h5>
        <h2 class="capitalize text-primary text-6xl leading-[80px] font-gothic font-normal">The Faces Behind Ausgezeichnet.cc</h2>
        <div class="col-sm-6">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>img-crcl.png" class="img-responsive img-circle">
            <?php _e('about us content left');?>
        </div>
        <div class="col-sm-6">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>img-crcl1.png" class="img-responsive img-circle">
            <?php _e('about us content right'); ?>
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
                <h2><?php _e('Management Marketing & Sales');?></h2>
                <?php _e('Management Marketing & Sales content'); ?>
            </div>
            <div class="col-sm-6">
                <h2><?php _e('Management Engineering');?></h2>
                <?php _e('Management Engineering content');?>
            </div>

        </div>
    </div>
</section>



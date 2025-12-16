
<!--<a href="<?php //echo make_url(); ?>">Homepage URL</a><br/>
<a href="<?php //echo make_url('login'); ?>">login</a><br/>
<a href="<?php //echo make_url('product',array('id'=>2)); ?>">product</a><br/>-->

<!-- Banner section start -->
<section class="banner relative bg-herobanner bg-cover bg-no-repeat lg:py-36 md:py-20 py-14">
    <div class="bg-black/60 absolute w-full h-full top-0 left-0 z-[0]"></div>
    <div class="relative flex items-center justify-center">
        <div class="container-custom">
            <div class="text-center text-white">
                <h3 class="mb-2 2xl:text-[40px] 2xl:leading-[50px] md:text-3xl md:leading-[40px] text-xl tracking-[0.4px] font-semibold text-white">Ausgezeichnet.cc</h3>
                <h1 class="2xl:text-8xl 2xl:leading-[120px] xl:text-6xl xl:leading-[80px] md:text-5xl md:leading-[60px] text-2xl leading-[38px] font-gothic  font-normal">
                    <?php _e('banner heading') ?>
                </h1>
            </div>
            <ul class="flex text-white items-center gap-2.5 flex-wrap 2xl:text-2xl lg:text-xl md:text-lg text-base font-medium md:mt-10 mt-6 justify-center mx-auto max-w-[1120px]">
                <li class="lg:py-2 md:py-1"><?php _e('banner tag1') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="lg:py-2 md:py-1"><?php _e('banner tag2') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="lg:py-2 md:py-1"><?php _e('banner tag3') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="lg:py-2 md:py-1"><?php _e('banner tag4') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="lg:py-2 md:py-1"><?php _e('banner tag5') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="lg:py-2 md:py-1"><?php _e('banner tag6') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="lg:py-2 md:py-1"><?php _e('banner tag7') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="lg:py-2 md:py-1"><?php _e('banner tag8') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="lg:py-2 md:py-1"><?php _e('banner tag9') ?></li>
            </ul>
        </div>
    </div>
    
</section>

<!-- Banner section End --> 

<!-- About section start -->
<section class="xl:py-24 md:py-14 py-10" id="welcome" >
    <div class="container-custom">
        <?php _e("Welcome content"); ?>
        <div class="flex lg:flex-row flex-col xl:gap-14 md:gap-8 gap-6 xl:mb-10 lg:mb-5 mb-3">
            <div class="lg:w-1/2">
                <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>about.png" class="w-full rounded-[20px]">
            </div>
            <div class="lg:w-1/2 flex flex-col 2xl:gap-5 md:gap-3 gap-2">
                <h5 class="uppercase 2xl:text-xl text-lg text-dark font-semibold"><?php _e('about_us_heading') ?></h5>
                <h2 class="capitalize text-primary text-left 2xl:text-6xl 2xl:leading-[80px] xl:text-[40px] xl:leading-[54px] md:text-4xl md:leading-[50px] text-2xl leading-[38px] font-gothic font-normal"><?php _e('about_us_main_title') ?></h2>
                <p class="2xl:text-xl 2xl:leading-[50px] xl:text-lg xl:leading-[42px] text-base leading-[36px] text-dark font-normal"><?php _e('about_us_paragraph_1') ?></p>
            </div>
        </div>
        <div class="flex flex-col">
            <p class="2xl:text-xl 2xl:leading-[50px]  xl:text-lg xl:leading-[42px] text-base leading-[36px] text-dark font-normal"><?php _e('about_us_paragraph_2') ?></p>
        </div>
    </div>
</section>
<!-- About section end --> 

<section class="hand-band bg-body xl:py-24 md:py-14 py-10" id="products">
    <div class="container-custom">
        <div class="flex flex-col 2xl:gap-16 md:gap-10 gap-6">
            <div class="flex flex-col md:items-center items-start md:gap-5 gap-2">
                <h5 class="2xl:text-xl text-lg text-dark font-semibold uppercase"><?php _e('how it works'); ?></h5>
                <h2 class="md:text-center text-left text-primary 2xl:text-6xl 2xl:leading-[80px] xl:text-[40px] xl:leading-[54px] md:text-4xl md:leading-[50px] text-2xl leading-[38px] font-gothic font-normal max-w-[1250px] md:break-normal break-all"><?php _e('below shop main heading')?></h2>
            </div>
            <div class="flex flex-wrap 2xl:gap-10 xl:gap-8 w-full">
                <div class="flex xl:gap-14 md:gap-8 gap-6 lg:flex-row flex-col">
                     <div class="lg:w-[52%] w-full">
                        <h3 class="text-black font-gothic 2xl:text-[36px] 2xl:leading-[47px] xl:text-3xl xl:leading-[42px] md:text-2xl text-xl mb-3"><?php _e('Below shop content'); ?></h3>
                        <p class="text-dark 2xl:text-xl 2xl:leading-[50px] xl:text-lg xl:leading-[40px] text-base leading-[36px] font-normal"><?php _e('Below shop paragraph'); ?></p>
                    </div>
                    <div class="iframe_call  lg:w-[48%]">
                        <?php _e('montagevideo'); ?>
                    </div>
                </div>
                
                <div class="block w-full lg:mt-0 mt-5">
                    <p class="text-dark 2xl:text-xl 2xl:leading-[50px] xl:text-lg xl:leading-[40px] text-base leading-[36px] font-normal"><?php _e('Below shop paragraph2')?></p>
                 </div>
            </div>
            <div>
                <h3 class="text-black font-gothic 2xl:text-[36px] 2xl:leading-[47px] xl:text-3xl xl:leading-[42px] md:text-2xl text-xl  mb-3"><?php _e('miniatures content2'); ?></h3>
                <p class="text-dark 2xl:text-xl 2xl:leading-[50px] xl:text-lg xl:leading-[40px] text-base leading-[36px] font-normal"><?php _e('miniatures paragraph2'); ?></p>
            </div>
            <div>
                <!-- <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>Miniatur_collection.jpg" class="img-responsive"> -->
                <h3 class="text-black font-gothic 2xl:text-[36px] 2xl:leading-[47px] xl:text-3xl xl:leading-[42px] md:text-2xl text-xl mb-3"><?php _e('Below shop content3'); ?></h3>
                    <p class="text-dark 2xl:text-xl 2xl:leading-[50px] xl:text-lg xl:leading-[40px] text-base leading-[36px] font-normal"><?php _e('Below shop paragraph3'); ?></p>
            </div>
            <div>
                <!-- <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>Konfigurator.jpg" class="img-responsive konfigurator"> -->
                <h3 class="text-black font-gothic 2xl:text-[36px] 2xl:leading-[47px] xl:text-3xl xl:leading-[42px] md:text-2xl text-xl mb-3"><?php _e('Below shop content4'); ?></h3>
                <p class="text-dark 2xl:text-xl 2xl:leading-[50px] xl:text-lg xl:leading-[40px] text-base leading-[36px] font-normal"><?php _e('Below shop paragraph4'); ?></p>
            </div>
                <!--<section class="crousal-outer">
                    <div id="carousel-2" class="carousel slide" data-ride="carousel" data-pause="hover"> 
                       
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-2" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-2" data-slide-to="1"></li>
                            <li data-target="#carousel-2" data-slide-to="2"></li>
                            <li data-target="#carousel-2" data-slide-to="3"></li>
                        </ol>

                        
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

                        
                        <a class="left carousel-control" href="#carousel-2" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only"><?php _e("Previous"); ?></span> </a> <a class="right carousel-control" href="#carousel-2" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only"><?php _e('Next'); ?></span> </a> </div>
                </section>-->
                <section class="crousal-outer relative">
                        <button class="slick-prev custom-prev xl:left-10 md:left-5 left-0 xl:w-16 xl:h-16 md:h-12 md:w-12 h-6 w-6 bg-primary inline-flex items-center justify-center rounded-full z-[2] hover:bg-primary focus:bg-primary"><svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M27.812 17.5L7.18807 17.5M7.18807 17.5L17.5 27.812M7.18807 17.5L17.5 7.18803" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                        <button class="slick-next custom-next xl:right-10 md:right-5 right-0 xl:w-16 xl:h-16 md:h-12 md:w-12 h-6 w-6 bg-primary inline-flex items-center justify-center rounded-full hover:bg-primary focus:bg-primary z-[2]"><svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.18799 17.5L27.8119 17.5M27.8119 17.5L17.5 7.18803M27.8119 17.5L17.5 27.812" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                        <!-- Wrapper for slides -->
                        <div class="slider xl:px-36 md:px-20 px-7">
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>1f.png" class="w-full" alt="...">
                            </div>
                            <div > <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>2f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>3f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>4f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>5f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>6f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>7f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>8f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>9f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>10f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>11f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>12f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>13f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>14f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>15f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>16f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>17f.png" class="w-full" alt="...">
                                
                            </div>
                            <div> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>18f.png" class="w-full" alt="...">
                                
                            </div>
                        </div>

                        
                </section>
        </div>
    </div>
</section>	


<!-- Shop Ribbons start -->
<section class="shop-ribbons xl:py-24 md:py-14 py-10" id="shop-ribbon">
    <div class="container-custom">
        <div class="flex flex-col ">
            <h2 class="text-dark font-semibold 2xl:text-xl text-lg uppercase"><?php _e("products"); ?></h2>
            <h2 class="capitalize md:mt-4 mt-2 text-primary 2xl:text-6xl 2xl:leading-[80px] xl:text-[40px] xl:leading-[54px] md:text-4xl md:leading-[50px] text-2xl leading-[38px] font-gothic font-normal"><?php _e('explore_products_heading')?></h2>
        </div>
        
        <div class="flex xl:mt-14 md:mt-8 mt-6 2xl:gap-12 xl:gap-10 gap-5 lg:flex-nowrap flex-wrap">
            <div class="lg:w-1/3 md:w-[calc(50%-10px)] w-full">
                <div class="bg-body h-full rounded-[20px] flex flex-col">
                    <div class="w-full"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>shop-1.jpg" class="w-full rounded-tr-[20px] rounded-tl-[20px]"> </div>
                    <div class="2xl:p-10 xl:p-8 p-4 flex flex-col items-start flex-auto">
                        <h4 class="text-secondary max-w-xs capitalize 2xl:text-3xl md:text-2xl text-xl font-gothic font-normal md:mb-5 mb-3"><?php _e('medals'); ?></h4>
                        <div class="text-base leading-[30px] text-dark font-normal mb-10"><?php _e('original content') ?></div>
                        <a href="<?php echo make_url('home'); ?>#contact" class="capitalize mt-auto inline-flex bg-primary text-white min-h-12 px-5 rounded-xl items-center justify-center text-base font-semibold"><?php _e('contact us'); ?> </a>
                    </div>
                    
                </div>
            </div>
            <div class="lg:w-1/3 md:w-[calc(50%-10px)] w-full">
                <div class="bg-body h-full rounded-[20px] flex flex-col">
                    <div class="w-full"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>shop-2.jpg" class="w-full rounded-tr-[20px] rounded-tl-[20px]"> </div>
                    <div class="2xl:p-10 xl:p-8 p-4 flex flex-col items-start flex-auto">
                        <h4 class="text-secondary max-w-xs capitalize 2xl:text-3xl md:text-2xl text-xl font-gothic font-normal md:mb-5 mb-3"><?php _e('miniatures'); ?></h4>
                        <div class="text-base leading-[30px] text-dark font-normal mb-10"><?php _e('miniatures content'); ?></div>
                        <a href="<?php echo make_url('shop'); ?>#products" class="inline-flex mt-auto bg-primary text-white min-h-12 px-5 rounded-xl capitalize items-center justify-center text-base font-semibold"><?php _e("View all categories"); ?></a>
                    </div>
                </div>
            </div>
            <div class="lg:w-1/3 md:w-[calc(50%-10px)] w-full">
                <div class="bg-body h-full rounded-[20px] flex flex-col">
                    <div class="w-full"> <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>shop-3.jpg" class="w-full rounded-tr-[20px] rounded-tl-[20px]"> </div>
                    <div class="2xl:p-10 xl:p-8 p-4 flex flex-col items-start flex-auto">
                        <h4 class="text-secondary max-w-xs capitalize 2xl:text-3xl md:text-2xl text-xl font-gothic font-normal md:mb-5 mb-3"><?php _e('modular ribbons'); ?></h4>
                        <div class="text-base leading-[30px] text-dark font-normal mb-10"><?php _e('ribbons content'); ?></div>
                        <a href="<?php echo make_url('home'); ?>#products" class="mt-auto capitalize inline-flex bg-primary text-white min-h-12 px-5 rounded-xl items-center justify-center text-base font-semibold"><?php _e("more info"); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="text-center relative bg-shop xl:py-28 md:py-20 py-14">
    <div class="absolute top-0 left-0 w-full h-full bg-black/70"></div>
    <div class="flex items-center justify-center relative">
        <div class="container-custom">
            <div class="flex flex-col items-center justify-center max-w-[1060px] mx-auto gap-5">
                <h2 class="text-white md:break-normal break-all font-gothic font-normal 2xl:text-6xl 2xl:leading-[75px] xl:text-[40px] xl:leading-[54px] xl:max-w-[700px] max-w-[900px] md:text-4xl md:leading-[48px] text-2xl leading-[38px] mx-auto"><?php _e('cta_heading') ?></h2>
                <p class="text-[#E5E6E8] xl:text-xl font-normal xl:leading-[35px] md:text-lg md:leading-[32px] text-base leading-[30px]"><?php _e('cta_desc') ?></p>
                <a href="<?php echo make_url('shop'); ?>" class="text-white bg-primary text-base font-semibold px-7 inline-flex items-center justify-center rounded-xl min-h-12"><font><?php _e("Shop Now"); ?></font></a>
            </div>
        </div>
    </div>
</section>


<section class="xl:py-24 md:py-14 py-10" id="about-us">
    <div class="container-custom">
        <div class="xl:mb-14 md:mb-10 mb-6 flex flex-col">
            <h5 class="text-dark 2xl:text-xl text-lg font-semibold uppercase md:mb-5 mb-2"><?php _e("team member"); ?></h5>
            <h2 class="capitalize text-left md:break-normal break-all text-primary 2xl:text-6xl 2xl:leading-[80px] xl:text-[40px] xl:leading-[54px] md:text-4xl md:leading-[48px] text-2xl leading-[38px] font-gothic font-normal"><?php _e('faces_behind')?></h2>
        </div>
        
        <div class="flex w-full md:flex-nowrap flex-wrap md:flex-row flex-col items-start md:mb-14 mb-7">
            <div class="w-auto">
                <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>lukas.png" class="lg:max-w-[400px] lg:md:w-[400px] md:max-w-[300px] md:w-[300px] w-full">
            </div>
            <div class="bg-body xl:p-10 p-5">
                <h2 class="2xl:text-[36px] text-left xl:text-3xl md:text-2xl text-xl text-secondary font-gothic"><?php _e('team right heading') ?></h2>
                <h5 class="md:text-xl text-lg font-medium text-secondary md:mb-5 mb-3"><?php _e('team right position') ?></h5>
                <p class="text-base leading-[30px] text-secondary"><?php _e('team right bio') ?></p>
            </div>
        </div>
        <div class="flex w-full md:flex-nowrap flex-wrap md:flex-row flex-col-reverse items-start">
            <div class="bg-body xl:p-10 p-5">
                <h2 class="2xl:text-[36px] text-left xl:text-3xl md:text-2xl text-xl text-secondary font-gothic"><?php _e('team left heading') ?></h2>
                <h5 class="md:text-xl text-lg font-medium text-secondary md:mb-5 mb-3"><?php _e('team left position') ?></h5>
                <p class="text-base leading-[30px] text-secondary"><?php _e('team left bio') ?></p>
            </div>
            <div class="w-auto">
                <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>florian.png" class="lg:max-w-[400px] lg:w-[400px]  md:max-w-[300px] md:w-[300px] w-full">
            </div>
        </div>
    </div>
</section>
<section class="bg-map bg-cover bg-no-repeat xl:pt-24 md:pt-16 pt-10 xl:pb-28 md:pb-16 pb-10" id="contact">
    <div class="container-custom">
        <div class="flex 2xl:gap-0 gap-5 md:flex-nowrap flex-wrap">
            <div class="md:w-1/2 w-full">
                <h2 class="2xl:text-6xl text-left xl:text-[40px] md:text-4xl md:leading-[50px] text-2xl leading-[38px] text-white font-gothic md:mb-4 mb-2"><?php _e('Get In Touch'); ?></h2>
                <p class="text-white 2xl:text-xl 2xl:leading-[35px] md:text-lg text-base leading-[28px] md:leading-[30px] font-normal"><?php _e('Excellent. Cc  | Full-Modular Order Orders'); ?></p>
            </div>
            <div class="md:w-1/2 w-full">
                <div class="bg-white inline-flex flex-col xl:p-10 md:p-5 p-4 rounded-[20px] md:w-auto w-full">
                   <h2 class="2xl:text-[36px] xl:text-3xl md:text-2xl text-xl text-left max-w-[450px] font-gothic text-secondary capitalize xl:leading-[46px] mb-5"><?php _e('generalquestions'); ?></h2>
                   <div class="flex flex-col md:gap-5 gap-3 map-requests">
                        <p class="xl:text-xl md:text-lg text-base font-medium text-dark inline-flex gap-3"><?php _e('generalquestionsemail');?></p>
                        <p class="xl:text-xl md:text-lg text-base font-medium text-dark inline-flex gap-3"><?php _e('generalquestionscontact');?></p>
                   </div>
                    
                </div>
               
            </div>
        </div>
       
        <div class="flex 2xl:mt-0 mt-5 2xl:gap-60 xl:gap-32 md:gap-10 gap-5 lg:justify-end lg:flex-nowrap flex-wrap">
           <div class="bg-white inline-flex flex-col xl:p-10 md:p-5 p-4 rounded-[20px] md:w-auto w-full">
                <h2 class="2xl:text-[36px] xl:text-3xl md:text-2xl text-xl text-left max-w-[450px] font-gothic text-secondary capitalize xl:leading-[46px] md:mb-3 mb-2">
                    <?php _e('Management Engineering');?>
                </h2>
                <p class="xl:text-xl md:text-lg text-base font-medium text-secondary xl:mb-8 mb-5"><?php _e('Management Engineering content');?></p>
                <div class="flex flex-col md:gap-5 gap-3 map-requests">
                    <p class="xl:text-xl md:text-lg text-base font-medium text-dark inline-flex gap-3"><?php _e('Management Engineering email');?></p>
                    <p class="xl:text-xl md:text-lg text-base font-medium text-dark inline-flex gap-3"><?php _e('Management Engineering contact');?></p>
                </div>
           </div>
           <div class="bg-white inline-flex flex-col xl:p-10 md:p-5 p-4 rounded-[20px] md:w-auto w-full">
              <h2 class="2xl:text-[36px] xl:text-3xl md:text-2xl text-xl text-left max-w-[450px] font-gothic text-secondary capitalize xl:leading-[46px] md:mb-3 mb-2">
               <?php _e('Management Marketing & Sales');?>
              </h2>
              <p class="xl:text-xl md:text-lg text-base font-medium text-secondary xl:mb-8 mb-5"><?php _e('Management Marketing & Sales content');?></p>
               <div class="flex flex-col md:gap-5 gap-3 map-requests">
                    <p class="xl:text-xl md:text-lg text-base font-medium text-dark inline-flex gap-3"><?php _e('Management Marketing & Sales email');?></p>
                    <p class="xl:text-xl md:text-lg text-base font-medium text-dark inline-flex gap-3"><?php _e('Management Marketing & Sales contact');?></p>
                </div>
           </div>
        </div>
    </div>
</section>

<section class="bg-white xl:py-24 md:py-14 py-10">
    <div class="container-custom">
       <div class="flex items-center flex-wrap lg:gap-10 gap-7 justify-center">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge1.png" class="2xl:w-auto xl:w-32 lg:w-24 w-20" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge2.png" class="2xl:w-auto xl:w-32 lg:w-24 w-20" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge3.png" class="2xl:w-auto xl:w-32 lg:w-24 w-20" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge4.png" class="2xl:w-auto xl:w-32 lg:w-24 w-20" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge5.png" class="2xl:w-auto xl:w-32 lg:w-24 w-20" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge6.png" class="2xl:w-auto xl:w-32 lg:w-24 w-20" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge7.png" class="2xl:w-auto xl:w-32 lg:w-24 w-20" alt="...">
       </div>
    </div>
</section>



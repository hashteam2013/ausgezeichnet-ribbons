
<!--<a href="<?php //echo make_url(); ?>">Homepage URL</a><br/>
<a href="<?php //echo make_url('login'); ?>">login</a><br/>
<a href="<?php //echo make_url('product',array('id'=>2)); ?>">product</a><br/>-->

<!-- Banner section start -->
<section class="banner relative bg-herobanner bg-cover bg-no-repeat py-36">
    <div class="bg-black/60 absolute w-full h-full top-0 left-0 z-[0]"></div>
    <div class="relative flex items-center justify-center">
        <div class="container-custom">
            <div class="text-center text-white">
                <h3 class="mb-2 text-[40px] leading-[50px] tracking-[0.4px] font-semibold text-white">Ausgezeichnet.cc</h3>
                <h1 class="text-8xl font-gothic leading-[120px] font-normal">
                    <?php _e('banner heading') ?>
                </h1>
            </div>
            <ul class="flex text-white items-center gap-2.5 flex-wrap text-2xl font-medium mt-10 justify-center mx-auto max-w-[1120px]">
                <li class="py-2"><?php _e('banner tag1') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2"><?php _e('banner tag2') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2"><?php _e('banner tag3') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2"><?php _e('banner tag4') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2"><?php _e('banner tag5') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2"><?php _e('banner tag6') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2"><?php _e('banner tag7') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2"><?php _e('banner tag8') ?></li>
                <li class="block w-2.5 h-2.5 rounded-full bg-primary"></li>
                <li class="py-2"><?php _e('banner tag9') ?></li>
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
                <h5 class="uppercase text-xl text-dark font-semibold"><?php _e('about_us_heading') ?></h5>
                <h2 class="capitalize text-primary text-6xl leading-[80px] font-gothic font-normal"><?php _e('about_us_main_title') ?></h2>
                <p class="text-xl leading-[50px] text-dark font-normal"><?php _e('about_us_paragraph_1') ?></p>
            </div>
        </div>
        <div class="flex flex-col">
            <p class="text-xl leading-[50px] text-dark font-normal"><?php _e('about_us_paragraph_2') ?></p>
        </div>
    </div>
</section>
<!-- About section end --> 

<section class="hand-band bg-body py-24" id="products">
    <div class="container-custom">
        <div class="flex flex-col gap-16">
            <div class="flex flex-col items-center gap-5">
                <h5 class="text-xl text-dark font-semibold uppercase"><?php _e('how it works'); ?></h5>
                <h2 class="text-center text-primary text-6xl leading-[80px] font-gothic font-normal max-w-[1250px]"><?php _e('below shop main heading')?></h2>
            </div>
            <div class="flex gap-14">
                <div class="lg:w-[52%] w-full">
                     <h3 class="text-black font-gothic text-[36px] leading-[47px] mb-3"><?php _e('Below shop content'); ?></h3>
                     <p class="text-dark text-xl leading-[43px] font-normal"><?php _e('Below shop paragraph'); ?></p>
                </div>
                <div class="iframe_call  lg:w-[48%]">
                    <?php _e('montagevideo'); ?>
                </div>
            </div>
                
                <div>
                    <h3 class="text-black font-gothic text-[36px] leading-[47px] mb-3"><?php _e('miniatures content2'); ?></h3>
                    <p class="text-dark text-xl leading-[43px] font-normal"><?php _e('miniatures paragraph2'); ?></p>
                </div>
                <div>
                    <!-- <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>Miniatur_collection.jpg" class="img-responsive"> -->
                    <h3 class="text-black font-gothic text-[36px] leading-[47px] mb-3"><?php _e('Below shop content3'); ?></h3>
                     <p class="text-dark text-xl leading-[43px] font-normal"><?php _e('Below shop paragraph3'); ?></p>
                </div>
                <div>
                    <!-- <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>Konfigurator.jpg" class="img-responsive konfigurator"> -->
                    <h3 class="text-black font-gothic text-[36px] leading-[47px] mb-3"><?php _e('Below shop content4'); ?></h3>
                    <p class="text-dark text-xl leading-[43px] font-normal"><?php _e('Below shop paragraph4'); ?></p>
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
                        <button class="slick-prev custom-prev left-10 w-16 h-16 bg-primary inline-flex items-center justify-center rounded-full z-[2] hover:bg-primary focus:bg-primary"><svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M27.812 17.5L7.18807 17.5M7.18807 17.5L17.5 27.812M7.18807 17.5L17.5 7.18803" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                        <button class="slick-next custom-next right-10 w-16 h-16 bg-primary inline-flex items-center justify-center rounded-full hover:bg-primary focus:bg-primary z-[2]"><svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.18799 17.5L27.8119 17.5M27.8119 17.5L17.5 7.18803M27.8119 17.5L17.5 27.812" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                        <!-- Wrapper for slides -->
                        <div class="slider px-36">
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
<section class="text-center relative bg-shop py-28">
    <div class="absolute top-0 left-0 w-full h-full bg-black/70"></div>
    <div class="flex items-center justify-center relative">
        <div class="container-custom">
            <div class="flex flex-col items-center justify-center max-w-[1060px] mx-auto gap-5">
                <h2 class="text-white font-gothic font-normal text-6xl max-w-[700px] mx-auto leading-[75px]">Ausgezeichnet.cc: Modular German Ribbon Bars</h2>
                <p class="text-[#E5E6E8] text-xl font-normal leading-[35px]">We produce the missing ribbons and miniatures needed to wear Austrian awards on German ribbon bars. We closed this long-standing gap in the market!</p>
                <a href="<?php echo make_url('shop'); ?>" class="text-white bg-primary text-base font-semibold px-7 inline-flex items-center justify-center rounded-xl min-h-12"><font><?php _e("Shop Now"); ?></font></a>
            </div>
        </div>
    </div>
</section>


<section class="py-24" id="about-us">
    <div class="container-custom">
        <div class="mb-14 flex flex-col">
            <h5 class="text-dark text-xl font-semibold uppercase mb-5"><?php _e("team member"); ?></h5>
            <h2 class="capitalize text-primary text-6xl leading-[80px] font-gothic font-normal">The Faces Behind Ausgezeichnet.cc</h2>
        </div>
        
        <div class="flex w-full items-start mb-14">
            <div class="w-auto">
                <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>lukas.png" class="max-w-[400px] w-[400px]">
            </div>
            <div class="bg-body p-10">
                <h2 class="text-[36px] text-secondary font-gothic "><?php _e('team right heading') ?></h2>
                <h5 class="text-xl font-medium text-secondary mb-5"><?php _e('team right position') ?></h5>
                <p class="text-base leading-[30px] text-secondary"><?php _e('team right bio') ?></p>
            </div>
        </div>
        <div class="flex w-full items-start">
            <div class="bg-body p-10">
                <h2 class="text-[36px] text-secondary font-gothic "><?php _e('team left heading') ?></h2>
                <h5 class="text-xl font-medium text-secondary mb-5"><?php _e('team left position') ?></h5>
                <p class="text-base leading-[30px] text-secondary"><?php _e('team left bio') ?></p>
            </div>
            <div class="w-auto">
                <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>florian.png" class="max-w-[400px] w-[400px]">
            </div>
        </div>
    </div>
</section>
<section class="bg-map bg-cover bg-no-repeat pt-24 pb-28" id="contact">
    <div class="container-custom">
        <div class="flex">
            <div class="w-1/2">
                <h2 class="text-6xl text-white font-gothic mb-4"><?php _e('Get In Touch'); ?></h2>
                <p class="text-white text-xl leading-[35px] font-normal"><?php _e('Excellent. Cc  | Full-Modular Order Orders'); ?></p>
            </div>
            <div class="w-1/2">
                <div class="bg-white inline-flex flex-col p-10 rounded-[20px]">
                   <h2 class="text-[36px] max-w-[450px] font-gothic text-secondary capitalize leading-[46px] mb-5"><?php _e('generalquestions'); ?></h2>
                   <div class="flex flex-col gap-5">
                        <p class="text-xl font-medium text-dark inline-flex gap-3"><?php _e('generalquestionsemail');?></p>
                        <p class="text-xl font-medium text-dark inline-flex gap-3"><?php _e('generalquestionscontact');?></p>
                   </div>
                    
                </div>
               
            </div>
        </div>
       
        <div class="flex gap-60 justify-end">
           <div class="bg-white inline-flex flex-col p-10 rounded-[20px]"">
                <h2 class="text-[36px] max-w-[450px] font-gothic text-secondary capitalize leading-[46px] mb-3">
                    <?php _e('Management Engineering');?>
                </h2>
                <p class="text-xl font-medium text-secondary mb-8"><?php _e('Management Engineering content');?></p>
                <div class="flex flex-col gap-5">
                    <p class="text-xl font-medium text-dark inline-flex gap-3"><?php _e('Management Engineering email');?></p>
                    <p class="text-xl font-medium text-dark inline-flex gap-3"><?php _e('Management Engineering contact');?></p>
                </div>
           </div>
           <div class="bg-white inline-flex flex-col p-10 rounded-[20px]"">
              <h2 class="text-[36px] max-w-[450px] font-gothic text-secondary capitalize leading-[46px] mb-3">
               <?php _e('Management Marketing & Sales');?>
              </h2>
              <p class="text-xl font-medium text-secondary mb-8"><?php _e('Management Marketing & Sales content');?></p>
               <div class="flex flex-col gap-5">
                    <p class="text-xl font-medium text-dark inline-flex gap-3"><?php _e('Management Marketing & Sales email');?></p>
                    <p class="text-xl font-medium text-dark inline-flex gap-3"><?php _e('Management Marketing & Sales contact');?></p>
                </div>
           </div>
        </div>
    </div>
</section>

<section class="bg-white py-24">
    <div class="container-custom">
       <div class="flex items-center gap-10 justify-center">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge1.png" class="" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge2.png" class="" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge3.png" class="" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge4.png" class="" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge5.png" class="" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge6.png" class="" alt="...">
            <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>badge7.png" class="" alt="...">
       </div>
    </div>
</section>



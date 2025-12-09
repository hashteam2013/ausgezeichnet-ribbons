<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <h2 class="mob-matter">Our Ribbon Gallery</h2>
        </div>
        <div class="col-sm-5">
            <div class="srch-bar">
                <input type="text" class="my-srch" placeholder="Search"><input type="button" class="btn srch-btn">
            </div>
        </div>
        <!--<div class="col-sm-4">
            <div class="srch-result">Showing Results 1 to 18 of 22 Total</div>
        </div>-->
    </div>
</div>

<div class="container">
    <div class="row">
        <!-----------------------Side-bar------------------------->
        <div class="col-sm-3 col-xs-4">
            <div class="categories">
                <div class="cat-heading"><?php _e("Categories"); ?></div>
                <ul>
                    <?php foreach ($categories as $cat) { ?>
                        <li><label><input type="checkbox" name="categories_name[]" class="cat_class" id="cat_id" value="<?php echo $cat->id ?>"><?php echo $cat->name_en; ?></label></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="categories">
                <div class="cat-heading"><?php _e("Departments"); ?></div>
                <ul>
                    <?php foreach ($departments as $depart) { ?>
                        <li><label><input type="checkbox" name="departments_name[]" class="depart_class" id="depart_id" value="<?php echo $depart->id; ?>"><?php echo $depart->name_en; ?></label></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="categories">
                <div class="cat-heading"><?php _e("Districts"); ?></div>
                <ul>
                    <?php foreach ($districts as $dist) { ?>
                        <li><label><input type="checkbox" name="districts_name[]" class="dist_class" id="dist_id" value="<?php echo $dist->id ?>"><?php echo $dist->name_en; ?></label></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!-----------------------Side-bar -end------------------------->
        <div class="col-sm-5 col-xs-8">
            <div class="srch-reslt">
                <div class="srch-heading"><?php _e("Search Result by category!"); ?></div>
                <div class="bdr">
                    <div class="flag-sec">
                        <!--<div class="conurty-nm"></div>-->
                        <div class="list">
                            <!--<li>
                                <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;  ?>ribbon1.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                                    <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                                </li>
                                <li>
                                <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;        ?>ribbon2.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                                <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                                </li>
                                <li>
                                <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;        ?>ribbon3.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                                <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                                </li>
                                <li>
                                <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;        ?>ribbon1.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                                <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                                </li>-->
                        </div>
                    </div>
                </div>
                <div class=" mar-top-10">
                    <!--<div class="conurty-nm">Bruck an der Mur district fire brigade</div>-->
                    <div class="flag-sec">
                        <div class="list_depart">
                            <!--<li>
                            <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;     ?>ribbon1.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                            <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                        </li>
                        <li>
                            <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;     ?>ribbon2.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                            <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                        </li>
                        <li>
                            <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;     ?>ribbon3.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                            <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                        </li>
                        <li>
                            <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;     ?>ribbon1.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                            <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                            </li>-->
                        </div>
                    </div>
                </div>
                <div class="  mar-top-10">
                    <!--<div class="conurty-nm">Bruck an der Mur district fire brigade</div>-->
                    <div class="flag-sec">
                        <div class="list_district">
                            <!--<li>
                            <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;     ?>ribbon1.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                            <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                        </li>
                        <li>
                            <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;     ?>ribbon2.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                            <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                        </li>
                        <li>
                            <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;     ?>ribbon3.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                            <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                        </li>
                        <li>
                            <div><img src="<?php //echo DIR_WS_ASSETS_IMAGES;     ?>ribbon1.png" class="img-responsive"></div><span><input type="button" class="add-list" value="Add to List"></span>
                            <p>Grandes of the honorary mark for services to the Republic of Austria</p>
                            </li>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="srch-reslt slect">
                <div class="srch-heading"><?php _e("Selected Items"); ?></div>
                <div class="padd-side">
                    <div class="pull-left">
                        <?php if (isset($app['logged_in_user']) && $app['logged_in_user'] != '') { //pr($customers);?>
                            <select id="custm"><?php
                                foreach ($customers as $cust) {?>
                                    <option value="<?php echo $cust['id']; ?>"><?php echo $cust['first_name']; ?></option>
                                <?php } ?>
                            </select> 
                    <?php } ?>
                    </div>
                    <input type="button" class="add-btn hvr-float-shadow add_cust" value="Add Customer">
                    <div class="check-tag">
                        <div class="batch">
<!--                        <ul>
                            <li>
                                <div>
                                    <img src="<?php //echo DIR_WS_ASSETS_IMAGES; ?>ribbon2.png" class="img-responsive"></div>
                                <span><label><input type="checkbox">Merit in Gold WCC STMK</label></span>
                            </li>
                            <li><div>
                                <img src="<?php //echo DIR_WS_ASSETS_IMAGES; ?>ribbon4.png" class="img-responsive"></div>
                                <span><label><input type="checkbox">Merit in Gold WCC STMK</label></span>
                            </li>
                            <li><img src="<?php //echo DIR_WS_ASSETS_IMAGES; ?>ribbon2.png" class="img-responsive"></div>
                                <span><label><input type="checkbox">Merit in Gold WCC STMK</label></span>
                            </li>
                            <li><div>
                                    <img src="<?php //echo DIR_WS_ASSETS_IMAGES; ?>ribbon2.png" class="img-responsive"></div>
                                <span><label><input type="checkbox">Merit in Gold WCC STMK</label></span>
                            </li>
                        </ul>-->
                        </div>
<!--                        <input type="button" class="delet-slct hvr-float-shadow delete" value="Delete Selected">
                        <input type="button" class="delet-slct hvr-float-shadow select" value="Select All">
                        <input type="button" class="cart-slct hvr-float-shadow" value="Add to Cart">-->
                    </div>
                </div>
            </div>
<!--            <div class="srch-reslt slect mar-top-10">
                <div class="srch-heading">
                    Badges Placed   
                </div>
                <div class="flag-contaner">

                    <div class="single-flag">
                        <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>ribbon1.png" class="img-responsive center-block">
                    </div>
                    <div class="dubble-flag">
                        <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>ribbon2.png" class="img-responsive"><img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>ribbon3.png" class="img-responsive">
                    </div>
                    <div class="dubbletriple-flag">
                        <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>ribbon5.png" class="img-responsive"><img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>ribbon1.png"  class="img-responsive"><img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>ribbon2.png"  class="img-responsive">
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>



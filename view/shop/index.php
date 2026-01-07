<div class="col-md-4 mob-blancer hidden">
    <a class="btn-cart" href="<?php echo make_url('cart');?>" title="<?php _e('View Cart'); ?>"><?php _e("Cart");?> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>&nbsp;&nbsp;
</div>
<div class="shop-search md:py-7 py-4 bg-body flex w-full">
    <div class="container-custom">
        <div class="srch-bar flex items-center justify-center max-w-[820px] xs:flex-row flex-col w-full mx-auto gap-2.5">
            <div class="relative flex items-center flex-auto xs:w-auto w-full">
                <svg width="24" height="24" class="absolute left-5 md:w-6 md:h-6 w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#2D4D7E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="text" id="search-box" class="my-srch w-full rounded-xl bg-white focus:outline-none border-[#b1b1b1] border md:min-h-14 min-h-10 md:ps-[52px] ps-10 md:text-base text-sm text-secondary font-medium" placeholder="<?php _e('search') ?>">
            </div>
           <input type="button" value="<?php _e('search') ?>" class="btn flex-1 xs:w-auto w-full xs:max-w-[200px] md:min-h-14 min-h-10 md:text-lg text-sm font-medium cursor-pointer rounded-lg srch-btn search_ribbon bg-primary text-white">
        </div>
    </div>
</div>
<div class="flex xl:py-16 md:py-10 py-8 w-full">
    <div class="container-custom">
        <div class="flex lg:flex-row flex-col 2xl:gap-14 xl:gap-6 gap-5">
            <!-----------------------Side-bar------------------------->
            <div class="high flex flex-col gap-5 lg:w-[22%] w-full">
                <h3 class="xl:text-3xl lg:text-2xl text-xl text-black font-gothic lg:block hidden"><?php _e("filters") ?></h3>
                <button class="flex items-center text-lg font-gothic cursor-pointer justify-between lg:hidden flex w-full py-2" id="filterBtn">
                    <span class="text-black font-gothic xl:text-2xl lg:text-xl text-lg font-medium"><?php _e("filters") ?></span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </button>
                <div class="flex flex-col bg-body rounded-xl xl:p-5 lg:p-3 p-5 gap-5 " id="sibebarfilter">
                    <div class="categories">
                        <div class="cat-heading xl:text-[22px] xl:leading-[32px] lg:text-xl text-lg text-black font-semibold"><?php _e("Categories"); ?></div>
                        <ul class="mt-5 flex flex-col gap-4 w-full">
                            <?php foreach ($categories as $key=>$cat) { ?>
                                <li class="text-dark shop-cat-list font-medium text-sm"><label class="relative flex items-center gap-2"><input type="checkbox" name="categories_name[]" class="cat_class min-w-[26px] h-[26px] absolute left-0 z-[1] opacity-0" id="cat_id_<?php echo $cat->position ?>"  dist-attr="<?php echo $cat->is_district_related; ?>" showclosed="<?php echo $cat->show_closed; ?>" value="<?php echo $cat->id ?>"> <span class="checkmark relative min-w-[26px] h-[26px] border-[1.5px] border-secondary inline-flex rounded-[5px]"></span><?php echo $cat->{'name_'.$app['language']}; ?></label></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="categories dist">
                        <div class="cat-heading xl:text-[22px] xl:leading-[32px] lg:text-xl text-lg text-black font-semibold"><?php _e("Districts"); ?></div>
                        <ul class="dist_ul mt-5 flex flex-col gap-4 w-full">
                            <?php foreach ($districts as $dist) { ?>
                                <li class="text-dark shop-cat-list  font-medium text-sm">
                                    <label class="relative flex items-center gap-2">
                                        <input type="checkbox" name="districts_name[]" class="dist_class min-w-[26px] h-[26px] absolute left-0 z-[1] opacity-0" id="dist_id_<?php echo $dist->id ?>" value="<?php echo $dist->id ?>"><span class="checkmark relative min-w-[26px] h-[26px] border-[1.5px] border-secondary inline-flex rounded-[5px]"></span><?php echo $dist->{'name_'.$app['language']}; ?></label></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="categories depart"> 
                        <div class="cat-heading xl:text-[22px] xl:leading-[32px] lg:text-xl text-lg text-black font-semibold"><?php _e("Collections"); ?></div> 
                        <ul class="mt-5 flex flex-col gap-4 w-full"> 
                            <?php foreach ($additional_categories as $key=>$add_cat) { ?> 
                                <li class="text-dark shop-cat-list  font-medium text-sm">
                                    <label class="relative flex items-center gap-2">
                                    <input type="checkbox" name="additional_categories_name[]" class="add_cat_class min-w-[26px] h-[26px] absolute left-0 z-[1] opacity-0" id="add_cat_id_<?php echo $add_cat->id; ?>" value="<?php echo $add_cat->id; ?>"><span class="checkmark relative min-w-[26px] h-[26px] border-[1.5px] border-secondary inline-flex rounded-[5px]"></span><?php echo $add_cat->{'name_'.$app['language']}; ?></label></li> 
                            <?php } ?> 
                        </ul> 
                    </div> 
                </div> 
            </div> 
            <!-----------------------Side-bar-end------------------------->
            <div class="srch-reslt flex flex-col gap-5 lg:w-[47%] w-full">
                <h3 class="xl:text-3xl lg:text-2xl  text-xl text-black font-gothic"><?php _e("product_categories") ?></h3>
                <!-- <div class="srch-heading"><?php _e("Search Result by category!"); ?></div> -->
                <div class="bdr">
                    <div class="flag-sec">
                        <div class="list flex flex-col gap-5">
                        </div>
                    </div>
                    <div class=" mar-top-10">
                    <!--<div class="conurty-nm">Bruck an der Mur district fire brigade</div>-->
                        <div class="flag-sec">
                            <div class="list_depart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mar-top-10">
                    <!--<div class="conurty-nm">Bruck an der Mur district fire brigade</div>-->
                    <div class="flag-sec">
                        <div class="list_district">
                        </div>
                    </div>
                </div>    
            </div>
           
            <div class="lg:w-[31%] w-full flex flex-col gap-5">
                <h3 class="xl:text-3xl lg:text-2xl text-xl text-black font-gothic"><?php _e("customer_listing")?></h3>
                <!-- <div class="srch-heading"><?php _e("Selected Items"); ?></div> -->
                <div class="bg-body 2xl:p-5 p-3 rounded-[20px] border border-[#D9D9D9]">
                    <div class="srch-reslt slect">
                            <div class="padd-side view-shops">
                                <div class="flex xl:flex-row lg:flex-col xs:flex-row flex-col xl:items-center 2xl:gap-5 gap-2 mb-5">
                                    <?php if (isset($app['logged_in_user']) && $app['logged_in_user'] != '') { //pr($customers);?>
                                    <?php if(!empty($customers)){ ?>
                                        <select id="custm" class="min-h-[46px] focus:outline-none cursor-pointer flex-1 text-black text-base font-regular rounded-[10px] 2xl:px-5 px-2 xl:max-w-[227px] lg:w-full w-auto border border-[#D9D9D9]"><?php
                                            foreach ($customers as $cust){ //pr($cust);
                                                if(!empty($cust)){ ?>
                                                <option value="<?php echo $cust['id']; ?>"><?php echo $cust['first_name'].' '.$cust['last_name'] ;  ?></option>
                                                <?php }else{  ?>
                                                <option><?php _e("No Customer"); ?></option>   
                                            <?php } } ?>
                                        </select> 
                                    <?php } else {?>
                                    <select id="custm" class="min-h-[46px] focus:outline-none cursor-pointer flex-1 text-black text-base font-regular rounded-[10px] 2xl:px-5 px-2 max-w-[227px] w-full border border-[#D9D9D9]" style="display: none;"></select>
                                    <?php } ?>
                                    <?php } else { ?>
                                     <select id="custm" class="min-h-[46px] focus:outline-none cursor-pointer flex-1 text-black text-base font-regular rounded-[10px] 2xl:px-5 px-2 max-w-[227px] w-full border border-[#D9D9D9]"><option><?php _e("Guest"); ?></option></select> 
                                     <?php } ?>
                                    <div class="relative">
                                        <svg width="18" height="18" class="absolute left-5 top-[14px] pointer-events-none" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 11.625H5.625C4.57833 11.625 4.05499 11.625 3.62914 11.7542C2.67034 12.045 1.92003 12.7953 1.62918 13.7541C1.5 14.18 1.5 14.7033 1.5 15.75M14.25 15.75V11.25M12 13.5H16.5M10.875 5.625C10.875 7.48896 9.36396 9 7.5 9C5.63604 9 4.125 7.48896 4.125 5.625C4.125 3.76104 5.63604 2.25 7.5 2.25C9.36396 2.25 10.875 3.76104 10.875 5.625Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <input type="button" class="add-btn rounded-lg cursor-pointer text-base font-semibold inline-flex items-center bg-primary min-h-[46px] text-white ps-[44px] pe-5  add_cust" value="<?php _e("Add Customer");?>">
                                    </div>
                                </div>
                                <?php if (isset($app['logged_in_user']) && $app['logged_in_user']!="") { ?>
                                <div class="mb-5 flex gap-2.5 items-center lg:justify-between">
                                    <h4 class="text-secondary xl:text-xl text-lg font-medium font-gothic"><?php _e("filters") ?></h4>
                                    <div id='show_buttons'>
                                        <?php 
                                        if (isset($app['logged_in_user']) && $app['logged_in_user'] != '' &&  !empty($selected_customer_batches)) { ?>
                                        <select id="action-dropdown" class="delet-slct min-h-[46px]  2xl:w-auto w-full focus:outline-none cursor-pointer text-black text-base font-regular rounded-[10px] xl:px-5 px-2.5 border border-[#D9D9D9]">
                                            <option value=""><?php _e("select_action");?></option>
                                            <option value="delete"><?php _e("Delete Selected");?></option>
                                            <option value="select"><?php _e("Select All");?></option>
                                            <option value="select_n"><?php _e("Select New");?></option>
                                        </select>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="check-tag flex overflow-y-auto max-h-[400px] flex-wrap bg-white rounded-[10px] xl:p-5 p-3 border border-[#D9D9D9]">
                                    <div class="w-full">
                                        <ul class="batch w-full flex flex-col">
                                                 <?php 
                                                foreach($selected_customer_batches as $batch)
                                                {
                                                    $found=0;
                                                    foreach($customer_order_items as $ordered_item)
                                                    {
                                                        $found=0;
                                                        if($ordered_item->product_id==$batch['batch_id'])
                                                        {
                                                            $ordered_str= '" "';
                                                            $ordered_int = 1;
                                                            $found=true;
                                                            break;
                                                        }

                                                    }

                                                    if($found==false)
                                                    {
                                                        $ordered_str = '" "';
                                                        $ordered_int = 0;
                                                    }


                                                
                                                ?>

                                            <li class="xl:mb-5 xl:pb-5 mb-4 pb-4 border-b border-[#D9D9D9] last:pb-0 last:mb-0 last:border-none flex gap-2.5 customer-list" id="ribbon_<?php echo $batch['id'] . $ordered_str ?>>

                                                <label class='relative'><input type='checkbox' class='chkid min-w-4 h-4 absolute left-0 z-[1] opacity-0' name='o<?php echo $ordered_int ?>' value='<?php echo $batch['id']; ?>'><span class='smallcheck relative min-w-4 h-4 border border-[#B1B1B1] inline-flex rounded-[2px]'></span></label>

                                                <?php echo show_ribbon_images($batch['type'],$batch['batch_image'],$batch['number'],$batch['country'],$batch['batch_id']); ?>
                                                <div><span class="text-sm font-medium text-black 2xl:break-normal break-all"><?php echo $batch['ribbon_name_'.$app['language']]; ?></span>
                                                </div>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex 2xl:flex-row lg:flex-col xs:flex-row flex-col md:flex-nowrap flex-wrap xl:gap-3 gap-2.5 xl:mt-10 mt-5 w-full">
                                        <a href = "javascript:void(0)" class="flex-1"><input type="button" class="cursor-pointer cart-slct w-full text-white font-medium rounded-lg  hover:bg-primary min-h-[46px] text-base bg-secondary divider md:px-0 px-2  add_to_cart_ribbon" value="<?php _e("Add to Cart"); ?>"></a>
                                        <a class="flex-1" href = "<?php echo make_url('cart');?>"><input type="button" class="cart-slct w-full text-white rounded-lg cursor-pointer hover:bg-primary min-h-[46px] text-base bg-secondary font-medium divider md:px-0 px-2 buy  view_cart" value="<?php _e("View Cart"); ?>"></a>
                                </div>
                                <?php }?>
                           </div>
                    </div>
                    

                 </div>
                
                 <?php if (isset($app['logged_in_user']) && $app['logged_in_user'] != '') { ?>

                  <div class="srch-heading">
                        <h3 class="xl:text-3xl lg:text-2xl text-xl text-black font-gothic capitalize"><?php _e("Badges Placed");?></h3>
                  </div>
                  <div class='badges bg-body 2xl:p-5 p-3 rounded-[20px] border border-[#D9D9D9]'>
                        <?php //foreach($selected_customer_batches as $custID){}
                        if (isset($app['logged_in_user']) && $app['logged_in_user'] != '' && !empty($selected_customer_batches)) {  ?>
                        <div class="srch-reslt slect mar-top-10">
                            
                            <div class="flag-contaner badges">
                                <?php } ?>
                            </div>
                        </div>
                   </div>
                   <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
 var customer_id = $('#custm').val();
         $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "show_list_1")); ?>",
            type: "post",
            dataType: "json",
            data: {
                'customer_id': customer_id,
            },
            success: function (data) {
                var total, placementOne = '', badgeData = '', totalBeforePreSort, totalBeforePreSortIntegrity;
                total = data.length-2;
                
                
                $(data).each(function (index, value) {
                
                if(index<total)
                {
                    badgeData += value.ribbon_type;
                    if (total % 3 == 1 && index == 0) {
                        var oneR1 = '<div class="ribbon_outer1"></div>';
                        badgeData = oneR1 + badgeData + oneR1;
                    }
                    else if (total % 3 == 2) 
                    {
                        if (index === 0) {
                            var twoR1 = '<div class="ribbon_outer2"></div>';
                            badgeData = twoR1 + badgeData;
                        }
                        if (index === 1) {
                            var twoR2 = '<div class="ribbon_outer2"></div>';
                            badgeData = badgeData + twoR2;
                        }
                    }
                }
                else if(index===total)
                {
                    totalBeforePreSort=value;
                }
                else
                {
                    totalBeforePreSortIntegrity=value;
                }
                    
                    
                });
                
                    tempvar1 = total % 3;
                    tempvar2 = total - tempvar1;
                    tempvar3 = tempvar2 * 2 / 3;
                    tempvar4 = sign(tempvar1);
                    tempvar5 = sign(3 * sign(tempvar3) + tempvar1 - 1)
                    tempvar6 = tempvar3 + tempvar4;
                    LConnectors = tempvar5 + tempvar6 - 1;
                    QConnectors = ((total - 3) + (total - 3) * sign(total - 3)) / 2;
                    if (total == 4 || total == 7 || total == 10 || total == 13 || total == 16)
                    {
                        QConnectors = QConnectors + 1;
                    }
                    if (total < 8)
                    {
                        nails = 2;
                    }
                    else
                    {
                        nails = 4;
                    }

	var strNotShown;

	strNotShown = "";
	if (total < totalBeforePreSort )
	{
		strNotShown += '<div class= "ribbonsnotshownsection"> Ihnen werden ' + (totalBeforePreSort  - total) + ' Ihrer ' + totalBeforePreSortIntegrity + ' Auszeichnungen nicht angezeigt, da in Ihrer Organisation nur die jeweils h&oumlchste Stufe einer Auszeichnung getragen wird. <a class="add-btn hvr-float-shadow" href="?page=profile" title="ribbonsnotshown">Einstellungen &auml;ndern</a></div>';
	}
	if (totalBeforePreSort < totalBeforePreSortIntegrity )
	{
		strNotShown += '<div class= "ribbonsnotshownsection"> Ihnen werden ' + (totalBeforePreSortIntegrity  - totalBeforePreSort) + ' Ihrer ' + totalBeforePreSortIntegrity + ' Auszeichnungen nicht angezeigt, da diese Dekorationen seitens Ihrer Organisation nicht zum Tragen zugelassen sind. <a class="add-btn hvr-float-shadow" href="?page=profile" title="ribbonsnotshown">Einstellungen &auml;ndern</a></div>';
	}
                
                $('.badges').html('<div class = "srch-reslt slect mar-top-10 flex flex-col">'+ '<p class="text-base text-black font-normal">' + strNotShown  + ' F&uumlr diese Spange ben&oumltigen Sie ' + LConnectors + " L&aumlngsverbinder und " + QConnectors + " Querverbinder. Wir empfehlen " + nails + " N&aumlgel. Bitte passen Sie die St&uumlckzahlen im Warenkorb an.  </p>" + '<div class="druken-btn flex gap-5 justify-between mt-5 mb-2.5"><a class="add-btn  text-base text-primary font-normal" href="https://www.ausgezeichnet.cc/?page=printBadgesPlaced&id=' + customer_id + '" title="invoice">Ansicht Drucken</a> <a class="add-btn text-base text-primary font-normal" href="https://www.ausgezeichnet.cc/?page=printFullBadgesPlaced&id=' + customer_id + '" title="invoice">Alle Drucken</a></div>'+'<div class="flag-contaner border border-[#D9D9D9] p-5 rounded-[10px] bg-white text-center">' +  badgeData + '</div></div></div>');
                if (total == '1') {
                    $(".flag-contaner img").css("max-width", "140px");
                    $(".flag-contaner").find(".ribbon_outer").addClass('opacity');
                }
            }
        });
    
    
function sign($n) {
  //  return ($n > 0) - ($n < 0);
if ( $n< 0 )
{
  return -1;
}
else if ( $n== 0 )
{
  return 0;
}
else
{
  return 1;
}
}

       </script>
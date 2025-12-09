<div class="container">

    <div class="row">
        <div class="col-sm-3">
            <h2 class="mob-matter"><?php _e("Our Ribbon Gallery"); ?></h2>
        </div>
        <div class="col-sm-5">
            <div class="srch-bar">
                <input type="text" id="search-box" class="my-srch" placeholder="Search"><input type="button" class="btn srch-btn search_ribbon">
            </div>
        </div>
        <div class="col-md-4 mob-blancer">
        <a class="btn-cart" href="<?php echo make_url('cart');?>" title="<?php _e('View Cart'); ?>"><?php _e("Cart");?> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>&nbsp;&nbsp;
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-----------------------Side-bar------------------------->
        <div class="col-sm-3 col-xs-4 high">
            <div class="categories">
                <div class="cat-heading"><?php _e("Categories"); ?></div>
                <ul>
                    <?php foreach ($categories as $key=>$cat) { ?>
                        <li><label><input type="checkbox" name="categories_name[]" class="cat_class" id="cat_id_<?php echo $cat->position ?>"  dist-attr="<?php echo $cat->is_district_related; ?>" showclosed="<?php echo $cat->show_closed; ?>" value="<?php echo $cat->id ?>"><?php echo $cat->{'name_'.$app['language']}; ?></label></li>
                    <?php } ?>
                </ul>
            </div>
              <div class="categories dist">
                <div class="cat-heading"><?php _e("Districts"); ?></div>
                <ul class="dist_ul">
                    <?php foreach ($districts as $dist) { ?>
                        <li><label><input type="checkbox" name="districts_name[]" class="dist_class" id="dist_id_<?php echo $dist->id ?>" value="<?php echo $dist->id ?>"><?php echo $dist->{'name_'.$app['language']}; ?></label></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="categories depart"> 
                 <div class="cat-heading"><?php _e("Collections"); ?></div> 
                 <ul> 
                     <?php foreach ($additional_categories as $key=>$add_cat) { ?> 
                         <li><label><input type="checkbox" name="additional_categories_name[]" class="add_cat_class" id="add_cat_id_<?php echo $add_cat->id; ?>" value="<?php echo $add_cat->id; ?>"><?php echo $add_cat->{'name_'.$app['language']}; ?></label></li> 
                     <?php } ?> 
                 </ul> 
            </div> 
         </div> 
        <!-----------------------Side-bar-end------------------------->
        <div class="col-sm-5 col-xs-8">
            <div class="srch-reslt">
                <div class="srch-heading"><?php _e("Search Result by category!"); ?></div>
                <div class="bdr">
                    <div class="flag-sec">
                    <div class="list">
                    </div>
                    </div>
                            <div class=" mar-top-10">
                    <!--<div class="conurty-nm">Bruck an der Mur district fire brigade</div>-->
                    <div class="flag-sec">
                        <div class="list_depart">
                        </div>
                    </div>
                </div>
                <div class="  mar-top-10">
                    <!--<div class="conurty-nm">Bruck an der Mur district fire brigade</div>-->
                    <div class="flag-sec">
                        <div class="list_district">
                        </div>
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
                        <?php if(!empty($customers)){ ?>
                            <select id="custm"><?php
                                foreach ($customers as $cust){ //pr($cust);
                                    if(!empty($cust)){ ?>
                                    <option value="<?php echo $cust['id']; ?>"><?php echo $cust['first_name'].' '.$cust['last_name'] ;  ?></option>
                                    <?php }else{  ?>
                                     <option><?php _e("No Customer"); ?></option>   
                                   <?php } } ?>
                            </select> 
                        <?php } else {?>
                        <select id="custm" style="display: none;"></select>
                        <?php } ?>
                    <?php } else { ?>
                       <select id="custm"><option><?php _e("Guest"); ?></option></select> 
                    <?php } ?>
                    </div>
                    <input type="button" class="add-btn hvr-float-shadow add_cust" value="<?php _e("Add Customer");?>">
                    <div class="check-tag">
                        <div>
                            <ul class="batch">
                              <?php 
		foreach($selected_customer_batches as $batch)
		{
			$found=0;
			foreach($customer_order_items as $ordered_item)
			{
				$found=0;
				if($ordered_item->product_id==$batch['batch_id'])
				{
					$ordered_str= '" style="background-color: #DDDDFF;"';
					$ordered_int = 1;
					$found=true;
					break;
				}

			}

			if($found==false)
			{
				$ordered_str = '" style="background-color: #F6F6F6;"';
				$ordered_int = 0;
			}


		
		?>

                                <li id="ribbon_<?php echo $batch['id'] . $ordered_str ?>>


                                   <?php echo show_ribbon_images($batch['type'],$batch['batch_image'],$batch['number'],$batch['country'],$batch['batch_id']); ?>
                                    <span><label><input type="checkbox" class="chkid" name="o<?php echo $ordered_int ?>" value="<?php echo $batch['id']; ?>"><?php echo $batch['ribbon_name_'.$app['language']]; ?></label></span>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div id='show_buttons'>
                        <?php 
                        if (isset($app['logged_in_user']) && $app['logged_in_user'] != '' &&  !empty($selected_customer_batches)) { ?>
                        <input type="button" class="delet-slct hvr-float-shadow delete" value="<?php _e("Delete Selected");?>">
                        <input type="button" class="delet-slct hvr-float-shadow select" value="<?php _e("Select All");?>">
	          <input type="button" class="delet-slct hvr-float-shadow select_w" value="<?php _e("Select wearables");?>">
	          <input type="button" class="delet-slct hvr-float-shadow select_n" value="<?php _e("Select New");?>">
                        <a href = "javascript:void(0)"><input type="button" class="cart-slct divider hvr-float-shadow add_to_cart_ribbon" value="<?php _e("Add to Cart"); ?>"></a>
                        <a href = "<?php echo make_url('cart');?>"><input type="button" class="cart-slct divider buy hvr-float-shadow view_cart" value="<?php _e("View Cart"); ?>"></a>
                        <?php } ?>
                        </div>
                </div>
                </div>
            </div>
           
            <div class='badges'>
             <?php //foreach($selected_customer_batches as $custID){}
             if (isset($app['logged_in_user']) && $app['logged_in_user'] != '' && !empty($selected_customer_batches)) {  ?>


            <div class="srch-reslt slect mar-top-10">
 
                <div class="srch-heading ">
                    <?php _e("Badges Placed");?>
           </div>
                <div class="flag-contaner badges">
                <?php } ?>
	</div>
	</div>
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
                
                $('.badges').html('<div class = srch-reslt slect mar-top-10><div class=srch-heading><?php _e("Badges Placed"); ?></div>'+'<div class="druken-btn"><a class="add-btn hvr-float-shadow  pull-left" href="http://www.ausgezeichnet.cc/?page=printBadgesPlaced&id=' + customer_id + '" title="invoice">Ansicht Drucken</a> <a class="add-btn hvr-float-shadow pull-right" href="http://www.ausgezeichnet.cc/?page=printFullBadgesPlaced&id=' + customer_id + '" title="invoice">Alle Drucken</a></div>'+'<div class=flag-contaner>' + '<p>' + strNotShown  + ' F&uumlr diese Spange ben&oumltigen Sie ' + LConnectors + " L&aumlngsverbinder und " + QConnectors + " Querverbinder. Wir empfehlen " + nails + " N&aumlgel. Bitte passen Sie die St&uumlckzahlen im Warenkorb an.  </p>" +badgeData + '</div></div></div>');
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
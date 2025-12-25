<?php //echo "<pre/>";print_R($user_detail);?>
<div class="filter-bar sampewr bg-body py-7 flex w-full">
    <div class="container-custom">
        <h1 class="text-3xl font-gothic text-black text-center"><?php _e("Checkout"); ?></h1>
    </div>
</div>
<div class="flex w-full py-20">
    <div class="container-custom">
        <form action='<?php echo make_url("checkout"); ?>' method='post' id="checkoutForm" class="flex gap-16">
            <div class="flex flex-col w-2/3">
                <h3 class="text-3xl text-black font-gothic mb-5"><?php _e("Billing Details"); ?></h3>
                <div class="p-5 rounded-[20px] border border-[#d9d9d9] border-solid  flex flex-col mb-14">
                <div class="chech-out ">
                    <?php
                    if (!empty($msg)) {
                        if ($msg == "Ungueltige Postleitzahl!") {
                            echo '<p style="color:red">' . UTF8_ENCODE('Unser System ist derzeit nur im Burgenland, in Ober&ouml;sterreich, der Steiermark und in Salzburg zugelassen. Ihrer Postleitzahl nach wollen Sie aus einem anderen Bundesland bestellen. Dies ist derzeit leider nicht m&oumlglich. Wir arbeiten daran, das System auch in Ihrem Bundesland verf&uuml;gbar zu machen. Bitte um Verst&auml;ndnis. Ihr Ausgezeichnet.cc-Team ') . '</p>';
                        }
                    }
                    ?>


                    <?php if ($user_detail->is_address_status == 1) { ?>
                        <div class="spot-a" id="billing_container" style="display:block">
                            
                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <input type = "hidden" value="" name="countrychange" id="countrychange">
                                <label class="text-base font-medium text-dark"><?php _e("Company"); ?></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='company' value="<?php echo $user_detail->company; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("First Name"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='fname' value="<?php echo $user_detail->first_name; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Last Name"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='lname' value="<?php echo $user_detail->last_name; ?>">
                            </div>
                            

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Phone No."); ?><font color="red">*</font></label>
                                <input type="tel" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='phone' value="<?php echo $user_detail->phone; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Email Address"); ?><font color="red">*</font></label>
                                <input type="email" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='email' value="<?php echo $user_detail->email; ?>">
                            </div>
                            
                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Address"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='addr' value="<?php echo $user_detail->address1; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Address2"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='addr2' value="<?php echo $user_detail->address2; ?>">
                            </div>
                            
                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Zip Code"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='zip' value="<?php echo $user_detail->zipcode; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Town / City"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='city' value="<?php echo $user_detail->city; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Country"); ?><font color="red">*</font></label>
                                <select name="country" id="country" class="country min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]">
                                    <option value=1 <?php echo ($user_detail->district != 30) ? 'selected' : '' ?> >Österreich</option>
                                    <option value=2 <?php echo ($user_detail->district == 30) ? 'selected' : '' ?>>Deutschland</option>
                                </select>
                            </div>

                            <div class="form-group flex gap-2.5">
                                <label class="flex items-center gap-2.5 green_label relative">
                                    <input type="checkbox" <?php echo ($shipping_form == 'none') ? "checked" : ""; ?> name="shipping_check" class="cc-hh opacity-0 absolute z-[1] left-0 w-4 h-4" id="ship">
                                    <span class="sm_checkmark  relative w-4 h-4 inline-flex border border-solid border-[#b1b1b1] rounded-[3px] "></span>
                                    <p class="text-sm font-medium text-black/55"><?php _e("Same billing shipping"); ?></p>
                                </label>
                            </div>
                        </div>
                </div>
                <?php } else { ?>
                        <div class="spot-a mt-7" id="billing_container" style="display:block">
                            <h3 class="text-3xl text-black font-gothic mb-5"><?php _e("Billing Details"); ?></h3>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Company"); ?></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='company' value="<?php echo isset($app['POST']['company']) ? $app['POST']['company'] : $cart_detail->billing_company; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("First Name"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='fname' value="<?php echo isset($app['POST']['fname']) ? $app['POST']['fname'] : $cart_detail->billing_firstname; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Last Name"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='lname' value="<?php echo isset($app['POST']['lname']) ? $app['POST']['lname'] : $cart_detail->billing_lastname; ?>">
                            </div>
                            
                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Phone No."); ?><font color="red">*</font></label>
                                <input type="tel" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='phone' value="<?php echo isset($app['POST']['phone']) ? $app['POST']['phone'] : $cart_detail->billing_mobile; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Email Address"); ?><font color="red">*</font></label>
                                <input type="email" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='email' value="<?php echo isset($app['POST']['email']) ? $app['POST']['email'] : $cart_detail->billing_email; ?>">
                            </div>
                            
                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Address"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='addr' value="<?php echo isset($app['POST']['addr']) ? $app['POST']['addr'] : $cart_detail->billing_address1; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Address2"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='addr2' value="<?php echo isset($app['POST']['addr2']) ? $app['POST']['addr2'] : $cart_detail->billing_address2; ?>">
                            </div>
                            
                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Zip Code"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='zip' value="<?php echo isset($app['POST']['zip']) ? $app['POST']['zip'] : $cart_detail->billing_zip; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Town / City"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='city' value="<?php echo isset($app['POST']['city']) ? $app['POST']['city'] : $cart_detail->billing_city; ?>">
                            </div>

                            <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Country"); ?><font color="red">*</font></label>
                                <select name="country" id="country" class="country min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]">
                                    <option value=1 selected="selected">Österreich</option>
                                    <option value=2>Deutschland</option>
                                </select>
                            </div>
                            <div class="form-group flex gap-2.5">
                                <label class="flex items-center gap-2.5 green_label relative">
                                    <input type="checkbox" <?php echo ($shipping_form == 'none') ? "checked" : ""; ?> name="shipping_check" class="cc-hh" id="ship">
                                    <span class="sm_checkmark relative w-4 h-4 inline-flex border border-solid border-[#b1b1b1] rounded-[3px]"></span>
                                    <p class="text-sm font-medium text-black/55"><?php _e("Same billing shipping"); ?></p>
                                </label>
                            </div>
                        </div>
                    <?php } ?>
                    <!----------------------------------------shipping different address----------------------------------------------------------------------->
                    <div class="spot-a mt-7" id="shipping_container" style="display:<?php echo $shipping_form; ?>">
                        <h3 class="text-3xl text-black font-gothic mb-5"><?php _e("Shipping Details"); ?></h3>

                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("Company"); ?></label>
                            <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='s_company' value="<?php echo isset($app['POST']['s_company']) ? $app['POST']['s_company'] : $cart_detail->billing_company; ?>">
                        </div>

                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("First Name"); ?><font color="red">*</font></label>
                            <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='s_fname' value="<?php echo isset($app['POST']['s_fname']) ? $app['POST']['s_fname'] : $cart_detail->shipping_firstname; ?>">
                        </div>

                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("Last Name"); ?><font color="red">*</font></label>
                            <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='s_lname' value="<?php echo isset($app['POST']['s_lname']) ? $app['POST']['s_lname'] : $cart_detail->shipping_lastname; ?>">
                        </div>
                        
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("Phone No."); ?><font color="red">*</font></label>
                            <input type="tel" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='s_phone' value="<?php echo isset($app['POST']['s_phone']) ? $app['POST']['s_phone'] : $cart_detail->shipping_mobile; ?>">
                        </div>

                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("Email Address"); ?><font color="red">*</font></label>
                            <input type="email" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='s_email' value="<?php echo isset($app['POST']['s_email']) ? $app['POST']['s_email'] : $cart_detail->shipping_email; ?>">
                        </div>
                        
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("Address"); ?><font color="red">*</font></label>
                            <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='s_addr' value="<?php echo isset($app['POST']['s_addr']) ? $app['POST']['s_addr'] : $cart_detail->shipping_address1; ?>">
                        </div>

                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("Address2"); ?><font color="red">*</font></label>
                            <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='s_addr2' value="<?php echo isset($app['POST']['s_addr2']) ? $app['POST']['s_addr2'] : $cart_detail->shipping_address2; ?>">
                        </div>
                        
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("Zip Code"); ?><font color="red">*</font></label>
                            <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='s_zip' value="<?php echo isset($app['POST']['s_zip']) ? $app['POST']['s_zip'] : $cart_detail->shipping_zip; ?>">
                        </div>

                        <div class="form-group flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("Town / City"); ?><font color="red">*</font></label>
                            <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name='s_city' value="<?php echo isset($app['POST']['s_city']) ? $app['POST']['s_city'] : $cart_detail->shipping_city; ?>">
                        </div>
                    </div>
                  </div>

                    <div class="form-group flex flex-col gap-5">
                        <label class="text-3xl text-black font-gothic"><?php _e("Order Comment"); ?></label>
                        <textarea  name="order_comment" class="feild-a pt-4 min-h-28 bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" id="order_comm" value="<?php echo isset($app['POST']['order_comment']) ? $app['POST']['order_comment'] : $cart_detail->order_comment; ?>"></textarea>
                    </div>
                </div>
                <div class="y-order w-1/3 flex flex-col gap-14">
                    <div class="flex flex-col gap-5">
                        <h3 class="text-3xl text-black font-gothic flex items-center justify-between"><?php _e("product_listing"); ?>
                            <a href="<?php echo make_url("cart"); ?>" class="pull-right" title="Update Order">
                                <svg width="20" height="20" class="pointer-events-none" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_714_1751)"><path d="M9.16602 3.33332H3.33268C2.89065 3.33332 2.46673 3.50891 2.15417 3.82147C1.84161 4.13403 1.66602 4.55796 1.66602 4.99999V16.6667C1.66602 17.1087 1.84161 17.5326 2.15417 17.8452C2.46673 18.1577 2.89065 18.3333 3.33268 18.3333H14.9993C15.4414 18.3333 15.8653 18.1577 16.1779 17.8452C16.4904 17.5326 16.666 17.1087 16.666 16.6667V10.8333M15.416 2.08332C15.7475 1.7518 16.1972 1.56555 16.666 1.56555C17.1349 1.56555 17.5845 1.7518 17.916 2.08332C18.2475 2.41484 18.4338 2.86448 18.4338 3.33332C18.4338 3.80216 18.2475 4.2518 17.916 4.58332L9.99935 12.5L6.66602 13.3333L7.49935 9.99999L15.416 2.08332Z" stroke="#393C40" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_714_1751"><rect width="20" height="20" fill="white"></rect></clipPath></defs>
                            </svg>
                            </a>
                        </h3>
                        <div class="bg-body rounded-[20px] border border-[#d9d9d9] p-5 flex flex-col">
                            <?php
                            $customer_name = "";
                            $confirmation_needed = 0;
                                foreach ($cart_items as $details) {//pr($details); 
                                ?>
                                <!-- <?php if ($customer_name != $details['customer_name']) { ?>
                                    <p class="c-name text-base font-medium text-secondary"><?php echo $details['customer_name']; ?></p>
                                    <?php $customer_name = $details['customer_name']; ?>
                                <?php } ?> -->
                                <div class="flex gap-2.5 justify-between mb-5 last:mb-0 pb-5 last:pb-0 last:border-none border-b border-solid border-[#d9d9d9]">
                                    <div class="flex flex-col gap-2.5">
                                        <?php echo show_ribbon_images($details['type'], $details['batch_image'], $details['number'], $details['country'], $details['product_id']); ?>
                                        <?php echo "<span class='text-sm font-medium text-black'>" .$details['ribbon_name_en'] . ' ' . "X " . $details['quantity']. "</span>"; ?>
                                        <?php
                                            if($details['confirm_comment']!="")
                                            {
                                            echo "<p style='color:#f00'><b>" . $details['confirm_comment'] . "</b></p>";
                                            echo "<br>";
                                                    $confirmation_needed = 1;
                                            }
                                        ?>
                                    </div>
                                    <p class="text-sm font-medium text-secondary"><?php echo show_price($details['quantity'] * $details['unit_price']); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="flex flex-col gap-5">
                       <h3 class="text-3xl text-black font-gothic billsum_heading"><?php _e("bill_summary")?></h3>
                       <div class="bg-body rounded-[20px] border border-[#d9d9d9] p-5 flex flex-col">
                           <div class="total text-sm font-normal text-secondary flex gap-2.5 justify-between">
                             <p class=""><?php _e("Total"); ?></p>
                             <p class=""><?php show_price(get_total()); ?></p>
                           </div>
                            <?php
                                if ($cart_detail->discount <> 0) {
                                    echo '<div class="total text-sm font-normal text-secondary flex gap-2.5 justify-between">';
                                    echo '<p>';
                                    echo 'Aktionspreis durch Code ' . ($cart_detail->rabattcode);
                                    echo '</p>';
                                    echo '<p>';
                                    echo show_price(get_total() * (1 - $cart_detail->discount));
                                    echo '</p>';
                                    echo '</div>';
                                }
                            ?>
                            <input type="hidden" class="total_amount_after_discount" value="<?php show_price(get_total() * (1 - $cart_detail->discount)); ?>"/>
                            <div class="total text-sm font-normal text-secondary flex gap-2.5 justify-between mt-5">
                                <p><?php _e("ShippingCost"); ?><br> <?php echo SHIPPING_COST_COMMENT;?></p>
                                <p class="area_shipping_cost"><?php show_price(shipingCostWithArea(get_total() * (1 - $cart_detail->discount),$area)); ?></p>
                            </div>
                            <div class="mt-5 text-sm font-medium text-black/55">
                                <p><?php echo SHIPPING_TIME_TITLE?> - <?php echo SHIPPING_TIME_VALUE?></p>
                            </div>
                            <div class="mt-5 pt-5 border-t border-solid border-[#d9d9d9] flex gap-2.5 text-sm font-medium text-black justify-between">
                                <p><?php _e('TotalShipping'); ?></p>
                                <p class="total_amnt_shipping_cost"><?php echo show_price(get_total() * (1 - $cart_detail->discount) + shipingCostWithArea(get_total() * (1 - $cart_detail->discount),$area)); ?></p>
                            </div>
                       </div>
                    </div>
                    <div class="flex flex-col gap-5">
                        <h3 class="text-3xl text-black font-gothic"><?php _e("Payment Gateway"); ?></h3>
                        <div class="bg-body rounded-[20px] border border-[#d9d9d9] p-5 flex flex-col">
                            <?php if (PAYMENT_GATEWAYS == 'Both') { ?>
                                <div class="flex flex-wrap gap-3 mb-5">
                                    <label class="radio text-sm text-secondary font-regular gap-2 flex items-center relative">
                                      <input type="radio" class="w-4 h-4 opacity-0 absolute left-0" <?php echo (DEFAULT_PAYMENT_GATEWAY == 'Paypal') ? "checked" : "" ?> name="payment_gateway" value="Paypal"/>
                                      <span class="radiocheck w-4 h-4 border border-[#b1b1b1] rounded-full"></span>
                                      Paypal
                                    </label>
                                   
                                    <label class="radio text-sm text-secondary font-regular gap-2 flex items-center relative">
                                        <input type="radio" class="w-4 h-4 opacity-0 absolute left-0" <?php echo (DEFAULT_PAYMENT_GATEWAY == 'banktransfer') ? "checked" : "" ?>  name="payment_gateway" value="banktransfer"/> 
                                        <span class="radiocheck w-4 h-4 border border-[#b1b1b1] rounded-full"></span>
                                        Vorauskasse
                                    </label>
                                    <?php
                                    if ($logged_in_user_info->is_trustworthy == 1) {
                                        ?>
                                        <label class="radio text-sm text-secondary font-regular gap-2 flex items-center relative">
                                            <input type="radio" class="w-4 h-4 opacity-0 absolute left-0" <?php echo (DEFAULT_PAYMENT_GATEWAY == 'onaccount') ? "checked" : "" ?>  name="payment_gateway" value="onaccount"/>
                                            <span class="radiocheck w-4 h-4 border border-[#b1b1b1] rounded-full"></span>
                                            Auf Rechnung
                                        </label>
                                    <?php } ?>
                                     <label class="radio text-sm text-secondary font-regular gap-2 flex items-center relative">
                                        <input type="radio" class="w-4 h-4 opacity-0 absolute left-0" <?php echo (DEFAULT_PAYMENT_GATEWAY == 'Sofort') ? "checked" : "" ?>  name="payment_gateway" value="Sofort" disabled="disabled"/> 
                                        <span class="radiocheck w-4 h-4 border border-[#b1b1b1] rounded-full"></span>
                                        Sofort - aus technischen Gründen derzeit nicht verfügbar
                                    </label>
                                </div>

                                <div class="flex flex-wrap flex-col ">
                                    <label for="agreeAGB" class="flex items-center gap-2.5 text-sm text-black/55 font-medium  green_label relative">  
                                        <input type="checkbox" class="opacity-0 absolute z-[1] left-0 w-4 h-4" name="agreeAGB" id="agreeAGB1"  value="1">
                                        <span class="sm_checkmark relative w-4 h-4 inline-flex border border-solid border-[#b1b1b1] rounded-[3px]"></span>
                                        <?php _e("I agree all terms and conditions"); ?>
                                    </label> 
                                    <?php
                                        if ($confirmation_needed == 1) {
                                            ?>
                                        <div class="form-group">
                                            <label for="agreeInfo">  <input type="checkbox" class="" name="agreeInfo" id="agreeInfo1"  value="1"><?php _e("I read and understood all additional infomation provided above"); ?></label>    
                                        </div>
                                            <?php
                                        }
                                            else
                                        {
                                        
                                            ?>
                                        <div class="form-group" >
                                            <label for="agreeInfo">  <input type="checkbox" style="visibility: hidden" class="" name="agreeInfo" id="agreeInfo1"  value="1" checked></label>    
                                        </div>
                                        <?php
                                       }
                                    ?>   
                                </div>
                               
                            <?php } ?>

                            <div>
                                 <button type='submit' name='place_order' class="plc-ordr all-cat add-btn min-h-10 inline-flex items-center justify-center rounded-md w-full bg-secondary text-white text-sm font-medium hover:bg-primary capitalize"><?php _e("Place order"); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document.body).on('change', ".country", function (e) {
        var val = $(this).val();
        var id = $(this).attr('id');
        $("#countrychange").val(val);
        let total_amount_befr_ship = $('.total_amount_after_discount').val();
        // console.log("total_amount_befr_ship",total_amount_befr_ship);
        addShippingCost(total_amount_befr_ship,val);
        // $("#checkoutForm").submit();
    });

    function addShippingCost(total_amount_befr_ship,area)
    {
        $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "getShippingCost")); ?>",
            type: "post",
            dataType: "json",
            data: {
                total_amount_befr_ship: total_amount_befr_ship,
                area: area
            },
            success: function (data) {
                // console.log("data",data);
                $('.area_shipping_cost').html('€'+data.shipping_code);
                $('.total_amnt_shipping_cost').html('€'+data.total_amnt);
                //$("#checkoutForm").submit();
            }
        });
    }
</script>










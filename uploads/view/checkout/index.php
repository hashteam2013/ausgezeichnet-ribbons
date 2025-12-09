<div class="filter-bar sampewr">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php _e("Checkout"); ?></h1>
            </div>
        </div>
    </div>
</div>
<form action='<?php echo make_url("checkout"); ?>' method='post' id="checkoutForm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-md-offset-2">
                <div class="chech-out">

                    <?php
                    if (!empty($msg)) {
                        if ($msg == "Ungueltige Postleitzahl!") {
                            echo '<p style="color:red">' . UTF8_ENCODE('Unser System ist derzeit nur im Burgenland, in Ober�sterreich und der Steiermark zugelassen. Ihrer Postleitzahl nach wollen Sie aus einem anderen Bundesland bestellen. Dies ist derzeit leider nicht m�glich. Wir arbeiten daran, das System auch in Ihrem Bundesland verf�gbar zu machen. Bitte um Verst�ndnis. Ihr Ausgezeichnet.cc-Team ') . '</p>';
                        }
                    }
                    ?>


                    <?php if ($user_detail->is_address_status == 1) { ?>
                        <div class="spot-a" id="billing_container" style="display:block">
                            <h3><?php _e("Billing Details"); ?></h3>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label><?php _e("Company"); ?></label>
                                    <input type="text" class="feild-a" name='company' value="<?php echo $user_detail->company; ?>">
                                </div></div>
                                <div class="form-group">
                                <div class="col-sm-6">
                                    <label><?php _e("First Name"); ?><font color="red">*</font></label>
                                    <input type="text" class="feild-a" name='fname' value="<?php echo $user_detail->first_name; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label><?php _e("Last Name"); ?><font color="red">*</font></label>
                                    <input type="text" class="feild-a" name='lname' value="<?php echo $user_detail->last_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label><?php _e("Phone No."); ?><font color="red">*</font></label>
                                    <input type="tel" class="feild-a" name='phone' value="<?php echo $user_detail->phone; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label><?php _e("Email Address"); ?><font color="red">*</font></label>
                                    <input type="email" class="feild-a" name='email' value="<?php echo $user_detail->email; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label><?php _e("Address"); ?><font color="red">*</font></label>
                                    <input type="text" class="feild-a" name='addr' value="<?php echo $user_detail->address1; ?>">
                                </div>


                                <div class="col-sm-6">
                                    <label><?php _e("Town / City"); ?><font color="red">*</font></label>
                                    <input type="text" class="feild-a" name='city' value="<?php echo $user_detail->city; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label><?php _e("Zip Code"); ?><font color="red">*</font></label>
                                    <input type="text" class="feild-a" name='zip' value="<?php echo $user_detail->zipcode; ?>">
                                    <label>
                                        <input type="checkbox" <?php echo ($shipping_form == 'none') ? "checked" : ""; ?> name="shipping_check" class="cc-hh" id="ship"><?php _e("Same billing shipping"); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="spot-a" id="billing_container" style="display:block">
                            <h3><?php _e("Billing Details"); ?></h3>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label><?php _e("Company"); ?></label>
                                    <input type="text" class="feild-a" name='company' value="<?php echo isset($app['POST']['company']) ? $app['POST']['company'] : $cart_detail->billing_company; ?>">
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-6">
                                    <label><?php _e("First Name"); ?><font color="red">*</font></label>
                                    <input type="text" class="feild-a" name='fname' value="<?php echo isset($app['POST']['fname']) ? $app['POST']['fname'] : $cart_detail->billing_firstname; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label><?php _e("Last Name"); ?><font color="red">*</font></label>
                                    <input type="text" class="feild-a" name='lname' value="<?php echo isset($app['POST']['lname']) ? $app['POST']['lname'] : $cart_detail->billing_lastname; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label><?php _e("Phone No."); ?><font color="red">*</font></label>
                                    <input type="tel" class="feild-a" name='phone' value="<?php echo isset($app['POST']['phone']) ? $app['POST']['phone'] : $cart_detail->billing_mobile; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label><?php _e("Email Address"); ?><font color="red">*</font></label>
                                    <input type="email" class="feild-a" name='email' value="<?php echo isset($app['POST']['email']) ? $app['POST']['email'] : $cart_detail->billing_email; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label><?php _e("Address"); ?><font color="red">*</font></label>
                                    <input type="text" class="feild-a" name='addr' value="<?php echo isset($app['POST']['addr']) ? $app['POST']['addr'] : $cart_detail->billing_address1; ?>">
                                </div>

                            </div>
                            <div class="form-group">

                                <div class="col-sm-6">
                                    <label><?php _e("Town / City"); ?><font color="red">*</font></label>
                                    <input type="text" class="feild-a" name='city' value="<?php echo isset($app['POST']['city']) ? $app['POST']['city'] : $cart_detail->billing_city; ?>">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-sm-6">
                                    <label><?php _e("Zip Code"); ?><font color="red">*</font></label>
                                    <input type="text" class="feild-a" name='zip' value="<?php echo isset($app['POST']['zip']) ? $app['POST']['zip'] : $cart_detail->billing_zip; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" <?php echo ($shipping_form == 'none') ? "checked" : ""; ?> name="shipping_check" class="cc-hh" id="ship"><p><?php _e("Same billing shipping"); ?></p>
                            </div>
                        </div>
                    <?php } ?>
                    <!----------------------------------------shipping different address----------------------------------------------------------------------->
                    <div class="spot-a" id="shipping_container" style="display:<?php echo $shipping_form; ?>">
                        <h3><?php _e("Shipping Details"); ?></h3>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label><?php _e("Company"); ?></label>
                                <input type="text" class="feild-a" name='s_company' value="<?php echo isset($app['POST']['s_company']) ? $app['POST']['s_company'] : $cart_detail->billing_company; ?>">
                            </div>
                            <div class="col-sm-6">
                                <label><?php _e("First Name"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a" name='s_fname' value="<?php echo isset($app['POST']['s_fname']) ? $app['POST']['s_fname'] : $cart_detail->shipping_firstname; ?>">
                            </div>
                            <div class="col-sm-6">
                                <label><?php _e("Last Name"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a" name='s_lname' value="<?php echo isset($app['POST']['s_lname']) ? $app['POST']['s_lname'] : $cart_detail->shipping_lastname; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label><?php _e("Phone No."); ?><font color="red">*</font></label>
                                <input type="tel" class="feild-a" name='s_phone' value="<?php echo isset($app['POST']['s_phone']) ? $app['POST']['s_phone'] : $cart_detail->shipping_mobile; ?>">
                            </div>
                            <div class="col-sm-6">
                                <label><?php _e("Email Address"); ?><font color="red">*</font></label>
                                <input type="email" class="feild-a" name='s_email' value="<?php echo isset($app['POST']['s_email']) ? $app['POST']['s_email'] : $cart_detail->shipping_email; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label><?php _e("Address"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a" name='s_addr' value="<?php echo isset($app['POST']['s_addr']) ? $app['POST']['s_addr'] : $cart_detail->shipping_address1; ?>">
                            </div>
                            <div class="col-sm-6">
                                <label><?php _e("Town / City"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a" name='s_city' value="<?php echo isset($app['POST']['s_city']) ? $app['POST']['s_city'] : $cart_detail->shipping_city; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label><?php _e("Zip Code"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a" name='s_zip' value="<?php echo isset($app['POST']['s_zip']) ? $app['POST']['s_zip'] : $cart_detail->shipping_zip; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php _e("Order Comment"); ?></label>
                        <textarea  name="order_comment" class="feild-a" id="order_comm" value="<?php echo isset($app['POST']['order_comment']) ? $app['POST']['order_comment'] : $cart_detail->order_comment; ?>"></textarea>
                    </div>
                    <div class="y-order">
                        <h3><?php _e("Your Order"); ?><a href="<?php echo make_url("cart"); ?>" class="pull-right" title="Update Order"><i class="fa fa-pencil"></i></a></h3>
                        <table>
                            <tr>
                                <th><?php _e("Product"); ?></th>
                                <th><?php _e("Total"); ?></th> 
                            </tr>
                            <?php
                            $customer_name = "";
                            foreach ($cart_items as $details) {//pr($details); 
                                ?>
                                <?php if ($customer_name != $details['customer_name']) { ?>
                                    <tr><td colspan="5" class="c-name"><?php echo $details['customer_name']; ?></td></tr>
                                    <?php $customer_name = $details['customer_name']; ?>
                                <?php } ?>
                                <tr>
                                    <td><?php echo $details['ribbon_name_en'] . ' ' . "X " . $details['quantity']; ?><br/>
                                        <?php echo show_ribbon_images($details['type'], $details['batch_image'], $details['number'], $details['country'], $details['product_id']); ?>
                                    </td>
                                    <td><?php echo show_price($details['quantity'] * $details['unit_price']); ?></td>
                                </tr>
                            <?php } ?>
                            <tr class="total">
                                <td><?php _e("Total"); ?></td>
                                <td><?php show_price(get_total()); ?></td>
                            </tr>

                            <?php
                            if (get_discount_string() <> "") {
                                echo '<tr class="total">';
                                echo '<td><h3>';
                                echo (get_discount_string());
                                echo '</h3></td>';
                                echo '<td><h3><strong>';
                                echo show_price(get_total() * (1 - $cart_detail->discount));
                                echo '</strong></h3></td>';
                                echo '</tr>';
                            }
                            ?>


                            <tr class="total">
                                <td><?php _e("ShippingCost"); ?></td>
                                <td><?php show_price(shipingCost(get_total() * (1 - $cart_detail->discount))); ?></td>
                            </tr>
                            <tr>
                                <td><h4><strong><?php _e('TotalShipping'); ?></strong></h4></td>
                                <td><h4><strong><?php echo show_price(get_total() * (1 - $cart_detail->discount) + shipingCost(get_total() * (1 - $cart_detail->discount))); ?></strong></h4></td>
                            </tr>
                            <tr>
                                <td><h4><strong>Voraussichtliche Lieferzeit</strong></h4></td>
                                <td><h4><strong>3 Tage nach Zahlungseingang</strong></h4></td>
                            </tr>



                            <?php if (PAYMENT_GATEWAYS == 'Both') { ?>
                                <tr>
                                    <td><?php _e("Payment Gateway"); ?></td>
                                    <td style="padding-left: 30px;">
                                        <label class="radio">
                                            <input type="radio" <?php echo (DEFAULT_PAYMENT_GATEWAY == 'Paypal') ? "checked" : "" ?> name="payment_gateway" value="Paypal"/> Paypal
                                        </label>
                                        <label class="radio">
                                            <input type="radio"<?php echo (DEFAULT_PAYMENT_GATEWAY == 'Sofort') ? "checked" : "" ?>  name="payment_gateway" value="Sofort"/> Sofort
                                        </label>
                                        <label class="radio">
                                            <input type="radio"<?php echo (DEFAULT_PAYMENT_GATEWAY == 'banktransfer') ? "checked" : "" ?>  name="payment_gateway" value="banktransfer"/> Vorauskasse
                                        </label>
                                        <?php
                                        if ($logged_in_user_info->is_trustworthy == 1) {
                                            ?>
                                            <label class="radio">
                                                <input type="radio"<?php echo (DEFAULT_PAYMENT_GATEWAY == 'onaccount') ? "checked" : "" ?>  name="payment_gateway" value="onaccount"/> Auf Rechnung
                                            </label>

                                        <?php } ?>


                                    </td>
                                </tr>
		<tr>
                            <td  colspan="6" >
                                        <div class="form-group">
                                                    <label for="agreeAGB">  <input type="checkbox" class="" name="agreeAGB" id="agreeAGB1"  value="1"><?php _e("I agree all terms and conditions"); ?></label>    
                                        </div>
		</td>
		</tr>
                            <?php } ?>
                            <tr align='center'><td colspan="2"><button type='submit' name='place_order' class="plc-ordr all-cat add-btn hvr-float-shadow"><?php _e("Place order"); ?></button></td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>













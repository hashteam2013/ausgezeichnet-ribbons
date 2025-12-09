<?php
//pr($_SESSION['user_id']);
global $app;
if (!LOGGED_IN_USER) {
    redirect(make_url('shop'));
}


add_css(DIR_WS_ASSETS_CSS . 'cart.css');





if (isset($app['POST']['place_order'])) {
 
            $msg = '';
    /* payment method check */
    $payment_method_name = DEFAULT_PAYMENT_GATEWAY;
    if(PAYMENT_GATEWAYS == 'Both'){
        $payment_method_name = isset($app['POST']['payment_gateway']) ? $app['POST']['payment_gateway'] : DEFAULT_PAYMENT_GATEWAY;
    } else{
        $payment_method_name = PAYMENT_GATEWAYS;
    }

	$acceptedAGB = isset($app['POST']['agreeAGB']) ? $app['POST']['agreeAGB'] : "";
	if( $acceptedAGB!='1')
	{
 		set_alert('error', 'Bitte akzeptieren Sie die AGBs.');
 		redirect(make_url('checkout'));
	}

	$acceptedInfo = isset($app['POST']['agreeInfo']) ? $app['POST']['agreeInfo'] : "";
	if( $acceptedInfo!='1')
	{
 		set_alert('error', 'Bitte quittieren Sie die Zusatzinfos.');
 		redirect(make_url('checkout'));
	}


    if (isset($app['POST']['shipping_check'])) {
        if (isset($app['user_key'])) {
            //pr($app['POST']);
            $company = isset($app['POST']['company']) ? $app['POST']['company'] : "";
            $fname = isset($app['POST']['fname']) ? $app['POST']['fname'] : "";
            $lname = isset($app['POST']['lname']) ? $app['POST']['lname'] : "";
            $phone = isset($app['POST']['phone']) ? $app['POST']['phone'] : "";
            $email = isset($app['POST']['email']) ? $app['POST']['email'] : "";
            $addr = isset($app['POST']['addr']) ? $app['POST']['addr'] : "";
            $addr2 = isset($app['POST']['addr2']) ? $app['POST']['addr2'] : ""; 
            $country = isset($app['POST']['country']) ? $app['POST']['country'] : "";
            $city = isset($app['POST']['city']) ? $app['POST']['city'] : "";
            $order_comment = isset($app['POST']['order_comment']) ? $app['POST']['order_comment'] : "";
            $state = isset($app['POST']['state']) ? $app['POST']['state'] : "";
            $zip = isset($app['POST']['zip']) ? $app['POST']['zip'] : "";

            $msg = '';
            if ($fname == "") {
                $msg = "Bitte Vornamen eingeben!";
            } else if ($lname == "") {
                $msg = "Bitte Nachnamen eingeben!";
            } else if ($phone == "") {
                $msg = "Bitte Telefonnummer eingeben!";
            } else if ($email == "") {
                $msg = "Bitte eMailadresse eingeben!";
            }  else if ($addr == "") {
                $msg = "Bitte Adresse eingeben!";
           }  else if ($addr2 == "") {
                $msg = "Bitte Hausnummer eingeben!";
           } else if ($city == "") {
                $msg = "Bitte Stadt eingeben!";
            } else if (is_zipcode_valid($zip)==false) {
                $msg = "Ungueltige Postleitzahl!";
            } else if ($zip == "") {
                $msg = "Postleitzahl ist notwendig!";
            } else if (strlen($zip)==5 && $country !=2) {
                $msg = "Laenderauswahl ungueltig!";
            } else if (strlen($zip)==4 && $country !=1) {
                $msg = "Laenderauswahl ungueltig!";
            } else {
                $query = new query('cart');
                $cart_id = get_cart_id();
                $query->Data['billing_company'] = ucwords($company);
                $query->Data['billing_firstname'] = ucwords($fname);
                $query->Data['billing_lastname'] = ucwords($lname);
                $query->Data['billing_address1'] = $addr;
                $query->Data['billing_address2'] = $addr2;
                $query->Data['billing_city'] = ucwords($city);
                $query->Data['billing_state'] = ucwords($state);
                $query->Data['billing_country'] = ucwords($country);
                $query->Data['billing_email'] = strtolower($email);
                $query->Data['billing_mobile'] = $phone;
                $query->Data['billing_zip'] = $zip;
                $query->Data['same_shipping_billing'] = '1';
                $query->Data['shipping_company'] = ucwords($company);
                $query->Data['shipping_firstname'] = ucwords($fname);
                $query->Data['shipping_lastname'] = ucwords($lname);
                $query->Data['shipping_address1'] = $addr;
                $query->Data['shipping_address2'] = $addr2;
                $query->Data['shipping_city'] = ucwords($city);
                $query->Data['shipping_state'] = ucwords($state);
                $query->Data['shipping_country'] = ucwords($country);
                $query->Data['shipping_email'] = strtolower($email);
                $query->Data['shipping_mobile'] = $phone;
                $query->Data['shipping_zip'] = $zip;
                $query->Data['order_comment'] = ucwords($order_comment);
                $query->Data['is_cart_saved'] = '1';
                $query->Data['payment_method_name'] = $payment_method_name;
                $query->Where = "where id = $cart_id";
                //$query->print=1;

                  set_alert('success', "Point 1 reached");


                if ($query->UpdateCustom()) {
                  set_alert('success', "Point 22 reached");

                    
                    redirect(make_url("payment"));
                    //set_alert('success', "Your Billing details have been added successfully");
                    //redirect(make_url("checkout"));
                    //$msg = 'Your Billing details have been added successfully';
                } else {
                    $msg = 'There is something wrong while filling form,Please Try Again!';
                }
            }
        }
    } else {

                  set_alert('success', "Point 2 reached");
        if (isset($app['user_key'])) {
            //pr($app['POST']);
            $company = isset($app['POST']['company']) ? $app['POST']['company'] : "";
            $fname = isset($app['POST']['fname']) ? $app['POST']['fname'] : "";
            $lname = isset($app['POST']['lname']) ? $app['POST']['lname'] : "";
            $email = isset($app['POST']['email']) ? $app['POST']['email'] : "";
            $phone = isset($app['POST']['phone']) ? $app['POST']['phone'] : "";
            $addr = isset($app['POST']['addr']) ? $app['POST']['addr'] : "";
            $addr2 = isset($app['POST']['addr2']) ? $app['POST']['addr2'] : "";
            $country = isset($app['POST']['country']) ? $app['POST']['country'] : "";
            $city = isset($app['POST']['city']) ? $app['POST']['city'] : "";
            $state = isset($app['POST']['state']) ? $app['POST']['state'] : "";
            $zip = isset($app['POST']['zip']) ? $app['POST']['zip'] : "";

            $scompany = isset($app['POST']['s_company']) ? $app['POST']['s_company'] : "";
            $sfname = isset($app['POST']['s_fname']) ? $app['POST']['s_fname'] : "";
            $slname = isset($app['POST']['s_lname']) ? $app['POST']['s_lname'] : "";
            $semail = isset($app['POST']['s_email']) ? $app['POST']['s_email'] : "";
            $sphone = isset($app['POST']['s_phone']) ? $app['POST']['s_phone'] : "";
            $saddr = isset($app['POST']['s_addr']) ? $app['POST']['s_addr'] : "";
            $saddr2 = isset($app['POST']['s_addr2']) ? $app['POST']['s_addr2'] : "";
            $scountry = isset($app['POST']['s_country']) ? $app['POST']['s_country'] : "";
            $scity = isset($app['POST']['s_city']) ? $app['POST']['s_city'] : "";
            $sstate = isset($app['POST']['s_state']) ? $app['POST']['s_state'] : "";
            $szip = isset($app['POST']['s_zip']) ? $app['POST']['s_zip'] : "";

                  set_alert('success', "Point 3 reached");
            $msg = '';
            if ($fname == "") {
                $msg = "Firstname is required!";
            } else if ($lname == "") {
                $msg = "Lastname is required!";
            } else if ($phone == "") {
                $msg = "Phone number is required!";
            } else if ($email == "") {
                $msg = "Email is required!";
            } else if ($addr == "") {
                $msg = "Address is required!";
           } else if ($addr2 == "") {
                $msg = "House number is required!";
            } else if ($city == "") {
                $msg = "City is required!";
            } else if ($zip == "") {
                $status = "error";
                $msg = "Zip code is required!";
            } else if ($sfname == "") {
                $msg = "Shipping firstname is required!";
            } else if ($slname == "") {
                $msg = "Shipping lastname is required!";
            } else if ($semail == "") {
                $msg = "Shipping email is required!";
            } else if ($sphone == "") {
                $msg = "Shipping phone number is required!";
            } else if ($saddr == "") {
                $msg = "Shipping address is required!";
            } else if ($scity == "") {
                $msg = "Shipping city is required!";
            } else if ($szip == "") {
                $msg = "Shipping zip code is required!";
            } else if (strlen($zip)==5 && $country !=2) {
                $msg = "Laenderauswahl ungueltig!";
            } else if (strlen($zip)==4 && $country !=1) {
                $msg = "Laenderauswahl ungueltig!";
            } else {
                $query = new query('cart');
                $cart_id = get_cart_id();
                $query->Data['billing_company'] = ucwords($company);
                $query->Data['billing_firstname'] = ucwords($fname);
                $query->Data['billing_lastname'] = ucwords($lname);
                $query->Data['billing_address1'] = $addr;
                $query->Data['billing_address2'] = $addr2;
                $query->Data['billing_city'] = ucwords($city);
                $query->Data['billing_state'] = ucwords($state);
                $query->Data['billing_country'] = ucwords($country);
                $query->Data['billing_email'] = strtolower($email);
                $query->Data['billing_mobile'] = $phone;
                $query->Data['billing_zip'] = $zip;
                $query->Data['same_shipping_billing'] = '0';

                $query->Data['shipping_company'] = ucwords($scompany);
                $query->Data['shipping_firstname'] = ucwords($sfname);
                $query->Data['shipping_lastname'] = ucwords($slname);
                $query->Data['shipping_address1'] = $saddr;
                $query->Data['shipping_address2'] = $saddr2;
                $query->Data['shipping_city'] = ucwords($scity);
                $query->Data['shipping_state'] = ucwords($sstate);
                $query->Data['shipping_country'] = ucwords($scountry);
                $query->Data['shipping_email'] = strtolower($semail);
                $query->Data['shipping_mobile'] = $sphone;
                $query->Data['shipping_zip'] = $szip;
                $query->Data['is_cart_saved'] = '1';
                $query->Data['payment_method_name'] = $payment_method_name;

                $query->Where = "where id = $cart_id";
                if ($query->UpdateCustom()) {
                    redirect(make_url("payment"));
                    //set_alert('success', "Your Shipping details has been added successfully");
                    //redirect(make_url("checkout"));
                } else {
                    $msg = 'There is something wrong while filling form,Please Try Again!';
                    $status = 'error';
                }
            }
        }
    }
    set_alert('error', $msg);
}

$query1 = new query('users');
$query1->Where = " where id = " . $_SESSION['user_id'];
$user_detail = $query1->DisplayOne();

$cart_id = get_cart_id();
$query1 = new query('cart');
$query1->Where = " where id = " . $cart_id;
$cart_detail = $query1->DisplayOne();

$query = new query('cart_items as ci');
$query->Field = "ci.id,ci.customer_id,ci.quantity,ci.product_id,ci.total_price_tax_excl,ci.unit_price,ci.type,ci.number,ci.country,b.confirm_comment, ci.year,b.batch_image,b.ribbon_name_".$app['language']." as ribbon_name_en,concat(c.first_name,' ',c.last_name) as customer_name";
$query->Where .= " LEFT JOIN batches as b ON b.id = ci.product_id";
$query->Where .= " LEFT JOIN customers as c ON c.id = ci.customer_id";
$query->Where .= " where cart_id= " . $cart_id . " order by customer_id";
$cart_items = $query->ListOfAllRecords();

if (empty($cart_items)) {
    set_alert('error', 'Please add ribbons in cart.');
    redirect(make_url("shop"));
}



$shipping_form = ($cart_detail->same_shipping_billing == '1') ? "none" : "block";
if (isset($app['POST']['place_order']) && !isset($app['POST']['shipping_check'])):
    $shipping_form = "block";
elseif (isset($app['POST']['place_order']) && isset($app['POST']['shipping_check'])):
    $shipping_form = "none";
endif;


//$countrychange = isset($app['POST']['countrychange']) ? $app['POST']['countrychange'] : '0';

//if (isset($app['POST']['countrychange'])) 
//{
//$area=countrychange;

//}
//else
//{
$query = new query("users");
$query->Field = "is_active,accepted_dsgvo1, district";
$query->Where = " where id = $logged_in_user_info->id";
//$query->print=1;
$dsgvo = $query->DisplayOne("object");
$dsgvo_status = $dsgvo->accepted_dsgvo1;

$query = new query("districts");
$query->Field = "id, area";
$query->Where = " where id = $dsgvo->district";
$area_query = $query->DisplayOne("object");
$area = $area_query->area;
//}
//echo $countrychange;

?>


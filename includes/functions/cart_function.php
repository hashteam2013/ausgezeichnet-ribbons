<?php
function get_cart_id() {
    global $app;
    $userkey = $_COOKIE["user_key"];
    $query = new query('cart');
    $query->Field = "id";
    $query->Where = " where cart_secure_key = '" . $userkey . "'";
    $cart = $query->DisplayOne();
    if (is_object($cart))
    {
        // UpdateCustom() was called here but no Data was set, causing SQL error
        // If you need to update cart, set Data fields before calling UpdateCustom()
        // Example:
        // if(get_discount_string()<>"") {
        //     $query->Data['discount']='0.07';
        // } else {
        //     $query->Data['discount']='0';
        // }
        // $query->UpdateCustom();

        return $cart->id;

    } else {
        $query = new query('cart');
        $query->Data['user_id'] = $app['user_info']->id;
        $query->Data['cart_secure_key'] = $_COOKIE["user_key"];
        $query->Data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $query->Data['same_shipping_billing'] = '1';
        $query->Data['date_add'] = '1';
	
//	if(get_discount_string()<>"")
//	{
//        		$query->Data['discount'] = '0.2';
//	}
//	else
//	{
//        		$query->Data['discount'] = '0';
//	}


        $query->Insert();
        return $query->GetMaxId();
    }
}

function get_discount_string()
{
    global $app;

	if(substr($app['user_info']->zipcode,0,2)=='90' || substr($app['user_info']->zipcode,0,2)=='91' || substr($app['user_info']->zipcode,0,2)=='92' || substr($app['user_info']->zipcode,0,2)=='93' || substr($app['user_info']->zipcode,0,2)=='94' || substr($app['user_info']->zipcode,0,2)=='95' || substr($app['user_info']->zipcode,0,2)=='96' || substr($app['user_info']->zipcode,0,2)=='97' || substr($app['user_info']->zipcode,0,2)=='98')
	{
	//	 return "";
	}
	return "";
	//return "Weihnachtsaktion -7% ";
}


function is_zipcode_valid($zip)
{
    global $app;
	//if(substr($zip,0,1)=='9' && substr($zip,0,2)!='99' )
	//{
	//	return false;
	//}
	return true;
}



function typeOrderUpdate($order_id,$type,$cid,$pid,$number,$country){
    $order_num = $order_id.'_'.$cid."_".$pid."_".$type;
    if($type == 1){
        $order_num.= "_n_".$number;
    }else if($type == 2){
        $order_num.= "_c_".$country;
    }
   return $order_num;
}

function get_total() {
    $cart_id = get_cart_id();
    $query = new query('cart_items');
    $query->Field = "SUM(total_price_tax_excl)";
    $query->Where = "where cart_id = " . $cart_id . "";
    $sum = $query->DisplayOne();
    foreach($sum as $total){
        return $total;
    }
}

function cart_empty(){
        $cart_id = get_cart_id();
        $query1 = new query("cart");
        $query1->Data['cart_secure_key'] = " ";
        $query1->Where = "where id = $cart_id";
        return $query1->UpdateCustom();
}


function place_order() {
    $output = array();
    $cart_id = get_cart_id();
    // copy all data from cart and cart items table into order and order items tables
    $query = new query("cart");
    $query->Where = "where id = $cart_id";
    $cart_details = $query->DisplayOne();
    $grand_total = get_total();
    //pr($grand_total);
    $query = new query('orders');
    $query->Field = "id";
    $query->Where = " where cart_id = '" . $cart_id . "'";
    $record = $query->DisplayOne();

    if (!is_object($record)) {
        //echo "not exist";exit();
        set_alert('success', "Point 25 reached");
        $query = new query("orders");
        $query->Data['cart_id'] = $cart_id;
        $query->Data['user_id'] = $cart_details->user_id;
        $query->Data['ip_address'] = $cart_details->ip_address;
        $query->Data['discount'] = $cart_details->discount;
        $query->Data['billing_company'] = $cart_details->billing_company;
        $query->Data['billing_firstname'] = $cart_details->billing_firstname;
        $query->Data['billing_lastname'] = $cart_details->billing_lastname;
        $query->Data['billing_address1'] = $cart_details->billing_address1;
        $query->Data['billing_address2'] = $cart_details->billing_address2;
        $query->Data['billing_city'] = $cart_details->billing_city;
        $query->Data['billing_state'] = $cart_details->billing_state;
        $query->Data['billing_country'] = $cart_details->billing_country;
        $query->Data['billing_zip'] = $cart_details->billing_zip;
        $query->Data['billing_fax'] = $cart_details->billing_fax;
        $query->Data['billing_email'] = $cart_details->billing_email;
        $query->Data['billing_mobile'] = $cart_details->billing_mobile;
        $query->Data['same_shipping_billing'] = $cart_details->same_shipping_billing;
        $query->Data['shipping_company'] = $cart_details->shipping_company;
        $query->Data['shipping_firstname'] = $cart_details->shipping_firstname;
        $query->Data['shipping_lastname'] = $cart_details->shipping_lastname;
        $query->Data['shipping_address1'] = $cart_details->shipping_address1;
        $query->Data['shipping_address2'] = $cart_details->shipping_address2;
        $query->Data['shipping_city'] = $cart_details->shipping_city;
        $query->Data['shipping_state'] = $cart_details->shipping_state;
        $query->Data['shipping_country'] = $cart_details->shipping_country;
        $query->Data['shipping_zip'] = $cart_details->shipping_zip;
        $query->Data['shipping_email'] = $cart_details->shipping_email;
        $query->Data['shipping_mobile'] = $cart_details->shipping_mobile;
        $query->Data['payment_method_name'] = $cart_details->payment_method_name;
        $query->Data['grand_total'] = $grand_total;
 	$query->Data['shipmenttarif'] = '30';
        $query->Data['order_comment'] = $cart_details->order_comment;
        $query->Data['current_state'] = 'Payment Pending';
        $query->Data['date_add'] = '1';

        $query->Data['total_shipping_amount'] = shipingCostWithArea($grand_total*(1-$cart_details->discount),$cart_details->shipping_country);
        $query->Data['is_order_valid'] = '1';
        //$query->print=1;
        if ($query->Insert()) {
        set_alert('success', "Point 26 reached");

            $order_id = $query->GetMaxId();
            $query = new query("cart_items");
            $query->Where = "where cart_id = $cart_id";
            $cartitems_details = $query->ListOfAllRecords();
            
            foreach ($cartitems_details as $orderitems) {//pr($orderitems);
                $query1 = new query('order_items');
                $query1->Data['order_id'] = $order_id;
                $query1->Data['customer_id'] = $orderitems['customer_id'];
                $query1->Data['product_id'] = $orderitems['product_id'];
                $query1->Data['type'] = $orderitems['type'];
                $query1->Data['number'] = $orderitems['number'];
                $query1->Data['country'] = $orderitems['country'];
                $query1->Data['year'] = $orderitems['year'];
                $query1->Data['quantity'] = $orderitems['quantity'];
                $query1->Data['quantity_initial'] = $orderitems['quantity'];

                $query1->Data['unit_price'] = $orderitems['unit_price'];
                $query1->Data['total_price_tax_excl'] = $orderitems['total_price_tax_excl'];
                $query1->Data['date_add'] = '1';
                $query1->insert();
                }
                $output['status'] = "success";
                $output['order_id'] = $order_id;
                
                  set_alert('success', "Point 26 reached");
                

    $queryMail = new query("users");
    $queryMail->Field = "id, email, accepted_eMail ";
    $queryMail->Where = " WHERE users.id IN(SELECT user_id FROM orders WHERE orders.id=" . $order_id . ") ";
     $ship_email = $queryMail->DisplayOne();
    $useremail = $ship_email->email;

    $query = new query("orders");
    $query->Field = " billing_email, shipping_email ";
    $query->Where = " WHERE orders.id=" . $order_id;
     $ship_email2 = $query->DisplayOne();
    $billing_email = $ship_email2->billing_email;
    $shipping_email = $ship_email2->shipping_email;



	if($ship_email->accepted_eMail==1)
	{
	                    /*main email */
	            $to = $useremail;
            		$subject = "Ihre Bestellung bei Ausgezeichnet.cc";
	            $txt = 'Sehr geehrte/r ' . $cart_details->billing_firstname . ' ' . $cart_details->billing_lastname . '. Vielen Dank fuer Ihr Interesse an unseren Produkten. Wir haben Ihre Bestellung erhalten, und werden diese umgehend bearbeiten. Bitte warten Sie mit einer etwaigen Bankueberweisung bis zum Erhalt unserer Rechnung, die Sie per E-Mail erhalten. Ihr Ausgezeichnet.cc - Team.';
           		 $headers = 'FROM:' . FROM_EMAIL . "\r\n" . 'Reply-To:' . REPLY_TO_EMAIL . "\r\n" . 'X-Mailer: PHP/' . phpversion();
		//mail($to, $subject, $txt, $headers);
	  //  SendEmail($subject, $to, FROM_EMAIL, 'Ausgezeichnet.cc', $txt);

            $to_admin = ADMIN_EMAIL;
            $subject_admin = "Bestellung Ausgezeichnet.cc";
            $txt_admin =  $useremail . ' hat eine Bestellung getaetigt. Billing eMail: ' . $billing_email  . ' Shipping eMail: ' . $shipping_email ;
            $headers_admin = 'FROM:' . FROM_EMAIL . "\r\n" . 'Reply-To:' . REPLY_TO_EMAIL . "\r\n" . 'X-Mailer: PHP/' . phpversion();
            //mail($to_admin, $subject_admin, $txt_admin, $headers_admin);
//	    SendEmail($subject_admin, $to_admin, FROM_EMAIL, 'Ausgezeichnet.cc - per SSL / SMTP NEU', $txt_admin);

            }
	else
	{
                	$to_admin = ADMIN_EMAIL;
                	$subject_admin = "Bestellung - eMails widersprochen";
		 $txt_admin = $useremail . ' ' . 'hat erfolgreich eine Bestellung getaetigt, WIDERSPRICHT ABER DER EMAIL ERKLAERUNG.';
                	$headers_admin = 'FROM:' . FROM_EMAIL . "\r\n" . 'Reply-To:' . REPLY_TO_EMAIL . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                	//mail($to_admin, $subject_admin, $txt_admin, $headers_admin);
	   // 		SendEmail($subject_admin, $to_admin, FROM_EMAIL, 'Ausgezeichnet.cc - per SSL / SMTP NEU', $txt_admin);
	}


        }
    } 
    else { 
       //echo "exist";exit();
        $query = new query("orders");
        //$query->Data['cart_id'] = $cart_id;
        $query->Data['user_id'] = $cart_details->user_id;
        $query->Data['ip_address'] = $cart_details->ip_address;
        $query->Data['discount'] = $cart_details->discount;
        $query->Data['billing_company'] = $cart_details->billing_company;
        $query->Data['billing_firstname'] = $cart_details->billing_firstname;
        $query->Data['billing_lastname'] = $cart_details->billing_lastname;
        $query->Data['billing_address1'] = $cart_details->billing_address1;
        $query->Data['billing_address2'] = $cart_details->billing_address2;
        $query->Data['billing_city'] = $cart_details->billing_city;
        $query->Data['billing_state'] = $cart_details->billing_state;
        $query->Data['billing_country'] = $cart_details->billing_country;
        $query->Data['billing_zip'] = $cart_details->billing_zip;
        $query->Data['billing_fax'] = $cart_details->billing_fax;
        $query->Data['billing_email'] = $cart_details->billing_email;
        $query->Data['billing_mobile'] = $cart_details->billing_mobile;
        $query->Data['same_shipping_billing'] = $cart_details->same_shipping_billing;
        $query->Data['shipping_company'] = $cart_details->shipping_company;
        $query->Data['shipping_firstname'] = $cart_details->shipping_firstname;
        $query->Data['shipping_lastname'] = $cart_details->shipping_lastname;
        $query->Data['shipping_address1'] = $cart_details->shipping_address1;
        $query->Data['shipping_address2'] = $cart_details->shipping_address2;
        $query->Data['shipping_city'] = $cart_details->shipping_city;
        $query->Data['shipping_state'] = $cart_details->shipping_state;
        $query->Data['shipping_country'] = $cart_details->shipping_country;
        $query->Data['shipping_zip'] = $cart_details->shipping_zip;
        $query->Data['shipping_email'] = $cart_details->shipping_email;
        $query->Data['shipping_mobile'] = $cart_details->shipping_mobile;
        $query->Data['payment_method_name'] = $cart_details->payment_method_name;
        $query->Data['grand_total'] = $grand_total;
        $query->Data['shipmenttarif'] = '30';
        $query->Data['order_comment'] = $cart_details->order_comment;
        //$query->Where = "where cart_id = $cart_id";
        $query->Where = "where id = '".$record->id."'";
        //$query->print=1;
        if ($query->UpdateCustom()) {
            $order_id = $record->id;
            //pr($order_id);
            // get order items
            $order_arr = array();
            $query = new query("order_items");
            $query->Where = "where order_id = $order_id";
            $orderitems_details = $query->ListOfAllRecords();

            foreach ($orderitems_details as $orderItems) {
                $order_arr[typeOrderUpdate($order_id, $orderItems['type'],$orderItems['customer_id'],$orderItems['product_id'],$orderItems['number'],$orderItems['country'])] = $orderItems['id'];
            }

            //pr($order_arr);
            // get cart items
           // $cart_num = array();
            $query = new query("cart_items");
            $query->Where = "where cart_id = $cart_id";
            $cartitems_details = $query->ListOfAllRecords();
           // pr($cartitems_details);
            foreach ($cartitems_details as $cartitems) {
                $cart_num = typeOrderUpdate($order_id,$cartitems['type'],$cartitems['customer_id'],$cartitems['product_id'],$cartitems['number'],$cartitems['country']);
                if (array_key_exists($cart_num, $order_arr)) { //echo "yes".$cart_num;
                    $query1 = new query('order_items');
                    $query1->Data['order_id'] = $order_id;
                    $query1->Data['customer_id'] = $cartitems['customer_id'];
                    $query1->Data['product_id'] = $cartitems['product_id'];
                    $query1->Data['type'] = $cartitems['type'];
                    $query1->Data['number'] = $cartitems['number'];
                    $query1->Data['country'] = $cartitems['country'];
                    $query1->Data['year'] = $cartitems['year'];
                    $query1->Data['quantity'] = $cartitems['quantity'];
                    $query1->Data['quantity_initial'] = $cartitems['quantity'];

                    $query1->Data['unit_price'] = $cartitems['unit_price'];
                    $query1->Data['total_price_tax_excl'] = $cartitems['total_price_tax_excl'];
                    $where = $cartitems['type']=="0"?'':'';
                    $where = $cartitems['type']=="10"?'':'';
                    $where = $cartitems['type']=="1"?' and number ='.$cartitems['number']:'';
                    $where = $cartitems['type']=="2"?' and country ='.$cartitems['country']:'';
                    $query1->Where = "where order_id = $order_id and customer_id = ".$cartitems['customer_id']." and product_id =" . $cartitems['product_id'].$where;
                    //$query1->print=1;
                    $query1->UpdateCustom();
                    unset($order_arr[$cart_num]);
                }
               else {
                    //echo "NO".$cart_num;
                    $query1 = new query('order_items');
                    $query1->Data['order_id'] = $order_id;
                    $query1->Data['customer_id'] = $cartitems['customer_id'];
                    $query1->Data['product_id'] = $cartitems['product_id'];
                    $query1->Data['type'] = $cartitems['type'];
                    $query1->Data['number'] = $cartitems['number'];
                    $query1->Data['country'] = $cartitems['country'];
                    $query1->Data['year'] = $cartitems['year'];
                    $query1->Data['quantity'] = $cartitems['quantity'];
                    $query1->Data['quantity_initial'] = $cartitems['quantity'];
                    $query1->Data['unit_price'] = $cartitems['unit_price'];
                    $query1->Data['total_price_tax_excl'] = $cartitems['total_price_tax_excl'];
                    $query1->Data['date_add'] = '1';
                    $query1->Insert();
                    //unset($order_arr[$cart_num]);
                }
            }
            if (!empty($order_arr)) {
                foreach ($order_arr as $delk => $delval) {
                    $query1 = new query('order_items');
                    $query1->Where = " where id = $delval";
                    $query1->Delete_where();
                } 
            }
            $output['status'] = "success";
            $output['order_id'] = $order_id;

            //$to = $cart_details->shipping_email;
            //$subject = "Ihre Bestellung bei Ausgezeichnet.cc";
            //$txt = 'Sehr geehrte Kundin, sehr geehrter Kunde. Wir haben Ihre Bestellung erhalten, und werden uns umgehend mit Ihnen in Verbindung setzen. Ihr Ausgezeichnet.cc - Team.';
            //$headers = 'FROM:'. FROM_EMAIL . "\r\n" . 'Reply-To:'.REPLY_TO_EMAIL . "\r\n" . 'X-Mailer: PHP/' . phpversion();
            //mail($to,$subject,$txt,$headers);
            //if(SEND_NEW_ORDER_EMAIL_TO_ADMIN == '1'){
            //  $to_admin = ADMIN_EMAIL;
            //  $subject_admin = "Bestellung";
            //  $txt_admin = $cart_details->shipping_email . ' '.  'hat eine Bestellung geaendert.';
            //  $headers_admin = 'FROM:'. FROM_EMAIL . "\r\n" . 'Reply-To:'.REPLY_TO_EMAIL . "\r\n" . 'X-Mailer: PHP/' . phpversion();
            //  mail($to_admin,$subject_admin,$txt_admin,$headers_admin);  
            //}
        }
    //} else {
    //    $output['msg'] = "Error occurred while placing order, Please try again!";
    //    $output['status'] = "error";
    }
    return $output;
}
?>

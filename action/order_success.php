<?php

global $app;
$cart_id = get_cart_id();
$order_id = isset($app['GET']['id']) ? $app['GET']['id'] : '';

if ($order_id != '') {
    /* get shipping email from order table */


    $query = new query("users");
    $query->Field = "email ";
    $query->Where = " WHERE 'users.id' IN(SELECT 'user_id' FROM orders' WHERE orders.id=" . $order_id . ") ";
     $ship_email = $query->DisplayOne();
    $acc_email = $ship_email->email;

    $query = new query("orders");
    $query->Field = " billing_email, shipping_email ";
    $query->Where = " WHERE orders.id=" . $order_id;
     $ship_email = $query->DisplayOne();
    $billing_email = $ship_email->billing_email;
    $shipping_email = $ship_email->shipping_email;


    if ($app['GET']['status'] == '1') {
        /* update order while completing transaction */
        $query = new query("orders");
        $query->Data['current_state'] = 'Waiting for confirmation';
        $query->Data['is_payment_made'] = '1';
        $query->Where = " where id = " . $order_id . " ";
        $query->UpdateCustom();
        $cart_empty = $query->DisplayOne();
        
        //cart_empty;
         cart_empty();
        

        $to =  $billing_email;


            $to_admin = ADMIN_EMAIL;
            $subject_admin = "Bestellung Ausgezeichnet.cc - über SSL / SMTP";
            $txt_admin =  $acc_email . ' ' . 'hat eine Bestellung aufgegeben. Billing eMail: ' . $billing_email  . ' Shipping eMail: ' . $shipping_email ;
            $headers_admin = 'FROM:' . FROM_EMAIL . "\r\n" . 'Reply-To:' . REPLY_TO_EMAIL . "\r\n" . 'X-Mailer: PHP/' . phpversion();
           // mail($to_admin, $subject_admin, $txt_admin, $headers_admin);
	   // SendEmail($subject_admin, $to_admin, FROM_EMAIL, 'Ausgezeichnet.cc', $txt_admin);

        set_alert("success", "Ihre Bestellung wurde erfolgreich abgesendet.");
        redirect(make_url("orders", array('id' => $order_id)));
    } else {
        if ($app['GET']['status'] == '0') {
            $to = $shiping_email;

            if (SEND_NEW_ORDER_EMAIL_TO_ADMIN == '1') {
                $to_admin = ADMIN_EMAIL;
                $subject_admin = "Ribbons Order";
                $txt_admin = $to . ' ' . 'has been ordered from your account without success';
                $headers_admin = 'FROM:' . FROM_EMAIL . "\r\n" . 'Reply-To:' . REPLY_TO_EMAIL . "\r\n" . 'X-Mailer: PHP/' . phpversion();
          //      mail($to_admin, $subject_admin, $txt_admin, $headers_admin);
            }
            
            set_alert("error", "Something went wrong , Please try again!");
            redirect(make_url("checkout"));
        }
    }
}
// logically user should not reach at this point 
// just to make sure if in any case user will reach here then it means payment process is wrong
redirect(make_url("checkout"));
?>

<?php 
global $app;
//$id=isset($app['GET']['id']) && $app['GET']['id']!="0";
$custom_id = $_REQUEST['custom'];
$mc_gross = $_REQUEST['mc_gross'];
$payment_date= $_REQUEST['payment_date'];
$txn_id = $_REQUEST['txn_id'];
//$cart_id = get_cart_id();

//pr(json_encode($_REQUEST));
//echo "hello";
//echo"<prE>";print_R($jsn);echo"</pre>";exit();
//$headers = 'From: info@hashsoftware.com' . "\r\n" .    'Reply-To: info@hashsoftware.com' . "\r\n" .          'X-Mailer: PHP/' . phpversion();
//mail('hashparasmaluja@gmail.com','hello',$txn_id,$headers);
//$jsn = json_decode($json, true);
    
$query = new query("orders");
$query->Data['payment_time '] = $payment_date ;
$query->Data['transaction_id'] = $txn_id;
$query->Data['payment_received'] = $mc_gross;
$query->Data['current_state'] = 'Payment Recived';
$query->Data['is_payment_made'] = '1';
$query->Where = " where id = '" . $custom_id."'";
$query->UpdateCustom();
$cart_empty =  $query->DisplayOne();

$query = new query("cart");
$query->Data['cart_secure_key'] = " ";
$query->Where = "where id = '".$cart_empty->cart_id."'";
$query->UpdateCustom();
?>
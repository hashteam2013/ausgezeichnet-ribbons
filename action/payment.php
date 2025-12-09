<?php
global $app;
//echo "hello";exit();
if (!LOGGED_IN_USER) {
    redirect(make_url('shop'));
}
$paypal_url = 'https://www.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
$paypal_id = 'office@ausgezeichnet.cc';

$cart_id = get_cart_id();
$query1 = new query('cart');
$query1->Where = " where id = " . $cart_id;
$cart_detail = $query1->DisplayOne();

if($cart_detail->is_cart_saved!='1'){
    set_alert('error','Please fill checkout form first!');
    redirect(make_url("checkout"));
}

$query = new query('cart_items as ci');
$query->Field = "ci.id,ci.customer_id,ci.quantity,ci.quantity_initial,ci.product_id,ci.total_price_tax_excl,ci.unit_price,b.batch_image,b.ribbon_name_en,concat(c.first_name,' ',c.last_name) as customer_name";
$query->Where .= " LEFT JOIN batches as b ON b.id = ci.product_id";
$query->Where .= " LEFT JOIN customers as c ON c.id = ci.customer_id";
$query->Where .= " where cart_id= " . $cart_id . " order by customer_id";
$cart_items = $query->ListOfAllRecords();

if(empty($cart_items)){
    set_alert('error','Please add ribbons in cart.');
    redirect(make_url("cart"));
}
$banktransfer = isset($app['GET']['banktransfer']) ? $app['GET']['banktransfer'] : "0";
$onaccount = isset($app['GET']['onaccount']) ? $app['GET']['onaccount'] : "0";

$order_info = place_order();


if($order_info['status']=='success'){


                  set_alert('success', "Point 24 reached");

    $order_id = $order_info['order_id'];
    if($banktransfer == '1' or $onaccount=='1'){
        cart_empty();
        set_alert('success', "Order placed successfully.");
        redirect(make_url('orders',array('id'=>$order_id)));
    }
    $query1 = new query('orders');
    $query1->Where = " where id = " . $order_id;
    $order_detail = $query1->DisplayOne();
    //pr($order_detail,false);exit();
} else{
    set_alert('error', $order_info['msg']);
    redirect(make_url("checkout"));
}
?>
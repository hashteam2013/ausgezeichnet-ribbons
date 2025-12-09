<?php

global $app;

if (!LOGGED_IN_USER) {
    redirect(make_url('shop'));
}
add_css(DIR_WS_ASSETS_CSS . 'cart.css');
/*
  1) get details from cart table - on secure key basis
  2) get all cart items - based on cart id in first step - 2 left joins - order by customer id
 */
$userid = $logged_in_user_info->id;

$cart_id = get_cart_id();

$query1 = new query('cart');
$query1->Where = " where id = ".$cart_id ;
$cart_detail = $query1->DisplayOne();

if (!empty($cart_detail)) {


	if ($cart_detail->user_id!=$logged_in_user_info->id)
	{
 	       $cookie_key = create_random_key(15);
 	       setcookie('user_key',$cookie_key,time() + (86400 * 30), "/");
 	       $app['user_key'] = $cookie_key;
	       $cart_id = get_cart_id();
	}

}

if (isset($app['POST']['update'])) {
    $quantity = $app['POST']['quant'];
    if (empty($quantity) == false) {
        $price = $app['POST']['price'];


        foreach ($quantity as $item_id => $new_quantity) {
            $query = new query("cart_items");
            $query->Where = " where id = $item_id";
            $cart_item_obj = $query->DisplayOne();

            if (empty($cart_item_obj) == false) {
                $cart_item_unit_price = $cart_item_obj->unit_price;
                $query = new query("cart_items");
                $query->Data['quantity'] = $new_quantity;
                $query->Data['quantity_initial'] = $new_quantity;
                $query->Data['total_price_tax_excl'] = $cart_item_unit_price * $new_quantity;
                $query->Where = " where id = $item_id";
                $query->UpdateCustom();
            }
        }
    }
} else if (isset($app['POST']['clear'])) {
    $id = $app['POST']['id'];
    $query = new query('cart_items');
    $query->Where = "Where cart_items.cart_id = $cart_id";
    $del = $query->Delete_where();
} else if (isset($app['POST']['sendrabatt'])) {
		$rabattcode=$app['POST']['rabattcode'];

                $query4 = new query('rabattcodes');
                $query4->Where = " where code = '" . $rabattcode . "'";
		$rabattcodeobject = $query4->DisplayOne();

		if (empty($rabattcodeobject) == false)
		{
		$rabattsatz=$rabattcodeobject->rabatt/100;
		set_alert('success', 'Code aktiviert. Sie erhalten ' . $rabattcodeobject->rabatt .'% Nachlass');

		}
		else
		{
  		  set_alert('error', "Code unbekannt");
		$rabattsatz=0;
		}
                $query3 = new query('cart');
                $query3->Data['rabattcode'] = $rabattcode;
		$query3->Data['discount'] = $rabattsatz;

                $query3->Where = " where id = ".$cart_id ;
                $query3->UpdateCustom();


}
else if (isset($app['POST']['gotocheckout'])) {



    redirect(make_url('checkout'));

} else if (isset($app['POST']['quant'])) {
   //pr($app['POST']);
    $quantity = $app['POST']['quant'];
    if (empty($quantity) == false) {
       $conn_id = isset($app['POST']['conn_val'])?$app['POST']['conn_val']:"";
        $price = $app['POST']['price'];
        //pr($quantity);
        foreach ($quantity as $item_id => $new_quantity) {
            $query = new query("cart_items");
            $query->Where = " where id = $item_id";
            //$query->print=1;
            $cart_item_obj = $query->DisplayOne();
            //echo "<pre>";print_r($cart_item_obj);echo "</pre>";
            if (!empty($cart_item_obj)) {
               // die("cxvxcvxcv");
                $cart_item_unit_price = $cart_item_obj->unit_price;
                $query = new query("cart_items");
                $query->Data['quantity'] = $new_quantity;
                $query->Data['quantity_initial'] = $new_quantity;
                $query->Data['total_price_tax_excl'] = $cart_item_unit_price * $new_quantity;
                $query->Where = " where id = $item_id";
                ///$query->print=1;
                $query->UpdateCustom();
                //redirect(make_url("cart", array(), '#'.$conn_id));
            }
        }redirect(make_url("cart", array(), '#'.$conn_id));
    }
}


$query1 = new query('cart');
$query1->Where = " where id = ".$cart_id ;
$cart_detail = $query1->DisplayOne();
//pr($cart_detail);

if (empty($cart_detail)) {
    set_alert('error', 'Bitte legen Sie zuerst Artikel in Ihren Warenkorb.');
    redirect(make_url("shop"));
}

	if ($cart_detail->user_id!=$logged_in_user_info->id)
	{
 	       $cookie_key = create_random_key(15);
 	       setcookie('user_key',$cookie_key,time() + (86400 * 30), "/");
 	       $app['user_key'] = $cookie_key;
	       $cart_id = get_cart_id();
	}
$query1 = new query('cart');
$query1->Where = " where id = ".$cart_id ;
$cart_detail = $query1->DisplayOne();

if (empty($cart_detail)) {
    set_alert('error', 'Bitte legen Sie zuerst Artikel in Ihren Warenkorb.');
    redirect(make_url("shop"));
}

$query = new query('cart_items as ci');
$query->Field = "ci.id,ci.customer_id as customer_id,ci.quantity,ci.quantity_initial,ci.product_id,ci.total_price_tax_excl,ci.unit_price,ci.type,ci.number,ci.country,ci.year,batch_image,b.ribbon_name_" . $app['language'] . " as ribbon_name_en,b.level as level,concat(c.first_name,' ',c.last_name) as customer_name, c.ShownName as ShownName, c.user_id as cuser_id";
$query->Where .= " LEFT JOIN batches as b ON b.id = ci.product_id";
$query->Where .= " LEFT JOIN customers as c ON c.id = ci.customer_id";
$query->Where .= " where cart_id= " . $cart_id . " order by customer_id, product_id=463 desc, product_id=461 desc, product_id=462 desc, ribbon_name_en asc";
$cart_items = $query->ListOfAllRecords();


if (empty($cart_items)) {
    set_alert('error', 'Bitte legen Sie zuerst Artikel in Ihren Warenkorb.');
    redirect(make_url("shop"));
}

$query3 = new query('customer_batches');
$query3->Field = "customer_id, count(customer_id) as NumberOfItems";
$query3->Where = "WHERE (customer_batches.customer_id IN(SELECT customers.id FROM `customers` WHERE customers.user_id = $cart_detail->user_id)  AND  customer_batches.batch_id NOT IN (461,462,463,546,554,552,553)) GROUP BY customer_id order by customer_id";
$customer_items = $query3->ListOfAllRecords('object');


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

?>
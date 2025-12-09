<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;

switch ($action):
    case 'list':
        $query = new query('orders');
        $query-> Field= " orders.id, orders.cart_id, orders.user_id, orders.billing_firstname, orders.billing_lastname, c.id as cid, orders.is_order_valid, orders.billing_email, orders.shipping_firstname, orders.shipping_lastname, orders.shipping_email, orders.comment, orders.grand_total, orders.discount, orders.total_shipping_amount, orders.payment_method_name, c.cart_secure_key, orders.is_payment_made, orders.date_add, orders.is_shipment_made, orders.is_packing_made"; 
        $query->Where= " LEFT JOIN cart as c ON c.id = orders.cart_id ";
        $query->Where .= " WHERE orders.is_order_valid=1 ORDER BY id desc";

        $orders = $query->ListOfAllRecords('object');



  //      $data =   pagination('orders',$limit,$page_no,$url='');
 //       $orders= $data['show_record'];
 //       $pagination = $data['pagination'];
        break;




    case 'listdebug':
        $query = new query('orders');
        $query-> Field= " orders.id, orders.cart_id, orders.user_id, orders.billing_firstname, orders.billing_lastname, c.id as cid, orders.is_order_valid, orders.billing_email, orders.shipping_firstname, orders.shipping_lastname, orders.shipping_email, orders.comment, orders.grand_total, orders.discount, orders.total_shipping_amount, orders.payment_method_name, c.cart_secure_key, orders.is_payment_made, orders.date_add, orders.is_shipment_made, orders.is_packing_made"; 
        $query->Where= " LEFT JOIN cart as c ON c.id = orders.cart_id ";
        $query->Where .= " ORDER BY id desc";

        $orders = $query->ListOfAllRecords('object');


 //       $data =   pagination('orders',$limit,$page_no,$url='');
 //      $orders= $data['show_record'];
    //    $pagination = $data['pagination'];
        break;
        

case 'close':

$query1 = new query("orders");
$query1->Where = " WHERE id=$id ";
$order = $query1->DisplayOne();


        $query1 = new query("cart");
        $query1->Data['cart_secure_key'] = " ";
        $query1->Where = "where id = $order->cart_id";

        $query1->UpdateCustom();


        $query= new query('orders'); 
        $query->Where = "where id =$id";
        $orders = $query->DisplayOne(); 
        $newquery = new query('users');
        $newquery->where = "id = $orders->user_id";
        $trust = $newquery->DisplayOne();
        $query_one = new query('order_items as oi');
        $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_en as batch_name,b.type as type,c.first_name as firstname,c.last_name as lastname,rl.name as location_name";
        $query_one->Where = " left join batches as b ON b.id = oi.product_id";
        $query_one->Where.= " left join customers as c ON c.id = oi.customer_id";
        $query_one->Where.= " left join ribbon_location as rl ON rl.id = oi.country";
        $query_one->Where.= " where oi.order_id =$id ORDER BY oi.customer_id";
        $orders_item = $query_one->ListOfAllRecords('object');


        $query= new query('order_items'); 
        $query_one -> Field = " order_id ";
        $query->Where = "where customer_id IN(Select id from 'customers' WHERE user_id=$orders->user_id) GROUP BY order_id";
        $customer_order_items = $query->ListOfAllRecords('object');



 case'view': 
 //   $query= new query('orders'); 
 //   $query->Where = "where id =$id";
//    $orders = $query->DisplayOne(); 
 //   $newquery = new query('users');
 //   $newquery->where = "id = $orders->user_id";
  //  $trust = $newquery->DisplayOne();
 //   $query_one = new query('order_items as oi');
//    $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_en as batch_name,b.type as type";
//    $query_one->Where = " left join batches as b ON b.id = oi.product_id";
//    $query_one->Where.= " where oi.order_id =$id";
//    $orders_item = $query_one->ListOfAllRecords('object');

        $query= new query('orders'); 
        $query->Where = "where id =$id";
        $orders = $query->DisplayOne(); 
        $newquery = new query('users');
        $newquery->where = "id = $orders->user_id";
        $trust = $newquery->DisplayOne();
        $query_one = new query('order_items as oi');
        $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_en as batch_name,b.type as type,c.first_name as firstname,c.last_name as lastname,rl.name as location_name";
        $query_one->Where = " left join batches as b ON b.id = oi.product_id";
        $query_one->Where.= " left join customers as c ON c.id = oi.customer_id";
        $query_one->Where.= " left join ribbon_location as rl ON rl.id = oi.country";
        $query_one->Where.= " where oi.order_id =$id ORDER BY oi.customer_id";
        $orders_item = $query_one->ListOfAllRecords('object');


        $query= new query('order_items'); 
        $query_one -> Field = " order_id ";
        $query->Where = "where customer_id IN(Select id from 'customers' WHERE user_id=$orders->user_id) GROUP BY order_id";
        $customer_order_items = $query->ListOfAllRecords('object');

//

case 'edit':
        if (isset($app['POST']['update'])) {
                $query = new query('orders');
                $query->Data['id'] = $id;
                $query->Data['total_shipping_amount'] = $app['POST']['shippingcosts'];
                $query->Data['is_payment_made'] = $app['POST']['paymentdone'];
                $query->Data['is_packing_made'] = $app['POST']['packingdone'];
                $query->Data['is_shipment_made'] = $app['POST']['shipmentdone'];
                $query->Data['discount'] = $app['POST']['discount'];
                $query->Data['is_order_valid'] = $app['POST']['ordervalid'];
                $query->Data['comment'] = $app['POST']['comment'];

                $formatteddeliverydate = $app['POST']['estimate_delivery_date'];
	 $formatteddeliverydate = date("Y-m-d H:i:s",strtotime($formatteddeliverydate));
	  $query->Data['estimate_delivery_date'] = $formatteddeliverydate;

                $formattedpaymenttime = $app['POST']['payment_time'];
	 $formattedpaymenttime = date("Y-m-d H:i:s",strtotime($formattedpaymenttime));
	  $query->Data['payment_time'] = $formattedpaymenttime;

	$query->Update();
	}

//    $query= new query('orders'); 
//    $query->Where = "where id =$id";
//    $orders = $query->DisplayOne(); 
//    $newquery = new query('users');
//    $newquery->where = "id = $orders->user_id";
//    $trust = $newquery->DisplayOne();
//    $query_one = new query('order_items as oi');
//    $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_en as batch_name,b.type as type";
//    $query_one->Where = " left join batches as b ON b.id = oi.product_id";
//    $query_one->Where.= " where oi.order_id =$id";
//    $orders_item = $query_one->ListOfAllRecords('object');

        $query= new query('orders'); 
        $query->Where = "where id =$id";
        $orders = $query->DisplayOne(); 
        $newquery = new query('users');
        $newquery->where = "id = $orders->user_id";
        $trust = $newquery->DisplayOne();
        $query_one = new query('order_items as oi');
        $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_en as batch_name,b.type as type,c.first_name as firstname,c.last_name as lastname,rl.name as location_name";
        $query_one->Where = " left join batches as b ON b.id = oi.product_id";
        $query_one->Where.= " left join customers as c ON c.id = oi.customer_id";
        $query_one->Where.= " left join ribbon_location as rl ON rl.id = oi.country";
        $query_one->Where.= " where oi.order_id =$id ORDER BY oi.customer_id";
        $orders_item = $query_one->ListOfAllRecords('object');


        $query= new query('order_items'); 
        $query -> Field = " customer_id, order_id, first_name, last_name ";
        $query->Where = " LEFT JOIN orders  ON orders.id=order_id LEFT JOIN customers ON customer_id=customers.id WHERE customer_id IN(Select id from customers WHERE user_id=$orders->user_id) AND orders.is_order_valid=1 AND order_id<>$id GROUP BY customer_id, order_id ";
        $customer_order_items = $query->ListOfAllRecords('object');

        $query= new query('order_items'); 
        $query -> Field = " customer_id, first_name, last_name ";
        $query->Where = " LEFT JOIN customers ON customers.id=order_items.customer_id WHERE order_items.order_id=$id GROUP BY customer_id";
        $customers_for_this_order = $query->ListOfAllRecords('object');


    endswitch;
?>

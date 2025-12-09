<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;

switch ($action):
    case 'list':
        $query = new query('orders');
        $query-> Field= " orders.id, orders.cart_id, orders.dpd_deliverystate, orders.is_payment_made, orders.is_packing_made, orders.user_id, orders.billing_firstname, orders.billing_lastname, c.id as cid, orders.is_order_valid, orders.is_order_cancelled, orders.billing_email, orders.shipping_firstname, orders.shipping_lastname, orders.shipping_email, orders.comment, orders.grand_total, orders.discount, orders.total_shipping_amount, orders.payment_method_name, c.cart_secure_key, orders.is_payment_made, orders.date_add, orders.is_shipment_made, orders.is_packing_made"; 
        $query->Where= " LEFT JOIN cart as c ON c.id = orders.cart_id ";
        $query->Where .= " WHERE orders.is_order_valid=1 ORDER BY  is_shipment_made, ";
	$query->Where .= " CASE WHEN is_shipment_made='1' THEN is_payment_made END, orders.id desc";

        $orders = $query->ListOfAllRecords('object');



  //      $data =   pagination('orders',$limit,$page_no,$url='');
 //       $orders= $data['show_record'];
 //       $pagination = $data['pagination'];
        break;




    case 'listdebug':
        $query = new query('orders');
        $query-> Field= " orders.id, orders.dpd_deliverystate, orders.cart_id, orders.user_id, orders.billing_firstname, orders.billing_lastname, c.id as cid, orders.is_order_valid, is_order_cancelled, orders.billing_email, orders.shipping_firstname, orders.shipping_lastname, orders.shipping_email, orders.comment, orders.grand_total, orders.discount, orders.total_shipping_amount, orders.payment_method_name, c.cart_secure_key, orders.is_payment_made, orders.date_add, orders.is_shipment_made, orders.is_packing_made"; 
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
        $newquery->where = " where id = $orders->user_id";
        $trust = $newquery->DisplayOne();
        $query_one = new query('order_items as oi');
        $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_en as batch_name,b.type as type,c.first_name as firstname,c.last_name as lastname, c.ShownName as ShownName,rl.name as location_name";
        $query_one->Where = " left join batches as b ON b.id = oi.product_id";
        $query_one->Where.= " left join customers as c ON c.id = oi.customer_id";
        $query_one->Where.= " left join ribbon_location as rl ON rl.id = oi.country";
        $query_one->Where.= " where oi.order_id =$id ORDER BY oi.customer_id";
        $orders_item = $query_one->ListOfAllRecords('object');


        $query= new query('order_items'); 
        $query_one -> Field = " order_id ";
        $query->Where = "where customer_id IN(Select id from 'customers' WHERE user_id=$orders->user_id) GROUP BY order_id";
        $customer_order_items = $query->ListOfAllRecords('object');



 case 'view': 


        $query= new query('orders'); 
        $query->Where = " where id = $id ";
        $orders = $query->DisplayOne(); 

        $query= new query('orders'); 
        $query->Where = " where user_id = $orders->user_id AND is_shipment_made = 0 AND is_order_valid = 1  AND id!=$id";
        $otherunfinishedorders = $query->ListOfAllRecords('object'); 

        $newquery = new query('users');
        $newquery->Where = " where id = $orders->user_id ";
        $trust = $newquery->DisplayOne();

        $query_one = new query('order_items as oi');
        $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_en as batch_name,b.type as type, c.first_name as firstname,c.last_name as lastname, c.ShownName as ShownName,rl.name as location_name";
        $query_one->Where = " left join batches as b ON b.id = oi.product_id";
        $query_one->Where.= " left join customers as c ON c.id = oi.customer_id";
        $query_one->Where.= " left join ribbon_location as rl ON rl.id = oi.country";
        $query_one->Where.= " where oi.order_id =$id ORDER BY oi.customer_id";
        $orders_item = $query_one->ListOfAllRecords('object');


        $query= new query('order_items'); 
        $query_one -> Field = " order_id ";
        $query->Where = "where customer_id IN(Select id from 'customers' WHERE user_id=$orders->user_id) GROUP BY order_id";
        $customer_order_items = $query->ListOfAllRecords('object');

        $query = new query('deliveryconditions');
        $query->Where = " order by position";
        $deliveryconditions = $query->ListOfAllRecords('object');

        $query = new query('paymentconditions');
        $query->Where = " order by position";
        $paymentconditions = $query->ListOfAllRecords('object');


        $query = new query('districts');
        $query->Where = " where id=$trust->district";
        $district = $query->DisplayOne(); 
	

        $query = new query('sub_districts');
        $query->Where = " where id=$trust->subdistrict";
        $subdistrict = $query->DisplayOne(); 


        $query = new query('departments_new');
        $query->Where = " where id=$trust->department_new";
        $department = $query->DisplayOne(); 


        $query = new query('departments_new');
        $query->Where = " where id=$trust->department_new2";
        $department2 = $query->DisplayOne();

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

                $query->Data['payment_method_name'] = $app['POST']['payment_method_name'];

               $query->Data['is_order_cancelled'] = $app['POST']['ordercancelled'];

                $query->Data['reminder_fee'] = $app['POST']['reminder_fee'];
                $query->Data['creditnote'] = $app['POST']['creditnote'];

                $query->Data['billing_company'] = $app['POST']['billing_company'];
                $query->Data['billing_firstname'] = $app['POST']['billing_firstname'];
                $query->Data['billing_lastname'] = $app['POST']['billing_lastname'];
                $query->Data['billing_address1'] = $app['POST']['billing_address1'];
                $query->Data['billing_address2'] = $app['POST']['billing_address2'];
                $query->Data['billing_city'] = $app['POST']['billing_city'];
                $query->Data['billing_mobile'] = $app['POST']['billing_mobile'];
                $query->Data['billing_email'] = $app['POST']['billing_email'];
                $query->Data['billing_zip'] = $app['POST']['billing_zip'];

        
                $query->Data['shipping_company'] = $app['POST']['shipping_company'];
                $query->Data['shipping_firstname'] = $app['POST']['shipping_firstname'];
                $query->Data['shipping_lastname'] = $app['POST']['shipping_lastname'];
                $query->Data['shipping_address1'] = $app['POST']['shipping_address1'];
                $query->Data['shipping_address2'] = $app['POST']['shipping_address2'];
                $query->Data['shipping_city'] = $app['POST']['shipping_city'];
                $query->Data['shipping_mobile'] = $app['POST']['shipping_mobile'];
                $query->Data['shipping_email'] = $app['POST']['shipping_email'];
                $query->Data['shipping_zip'] = $app['POST']['shipping_zip'];
                $query->Data['shipping_country'] = $app['POST']['shipping_country'];
                $query->Data['shipmenttarif'] = $app['POST']['shipmenttarif'];

                $query->Data['downpayment'] = $app['POST']['downpayment'];



                $query->Data['is_special'] = $app['POST']['is_special'];

               $query->Data['deliverycondition_id'] = $app['POST']['deliverycondition_id'];
               $query->Data['paymentcondition_id'] = $app['POST']['paymentcondition_id'];


                $query->Data['Override_TotalInvoice'] = $app['POST']['Override_TotalInvoice'];
                $query->Data['comment'] = $app['POST']['comment'];

                $query->Data['comment_top'] = $app['POST']['comment_top'];
                $query->Data['order_comment'] = $app['POST']['order_comment'];
	  $query->Data['override_delivery_date'] = $app['POST']['override_delivery_date'];
	  $query->Data['override_invoice_date'] = $app['POST']['override_invoice_date'];
	  $query->Data['override_order_date'] = $app['POST']['override_order_date'];

                $formatteddeliverydate = $app['POST']['estimate_delivery_date'];
     	 $formatteddeliverydate = date("Y-m-d H:i:s",strtotime($formatteddeliverydate));

	  $query->Data['estimate_delivery_date'] = $formatteddeliverydate;




                $formattedpaymenttime = $app['POST']['payment_time'];
	 $formattedpaymenttime = date("Y-m-d H:i:s",strtotime($formattedpaymenttime));
	  $query->Data['payment_time'] = $formattedpaymenttime;




        $query_one = new query('order_items as oi');
        $query_one -> Field = "oi.*";
        $query_one->Where.= " where oi.order_id =$id";
        $orders_item = $query_one->ListOfAllRecords('object');

        foreach ($orders_item as $order_item)
	{
	
		$query2 = new query('order_items');
                $query2->Data['id'] =$order_item->id;
                $query2->Data['pos'] = $app['POST']['pos_'.$order_item->id ];
                $query2->Data['inactive'] = $app['POST']['inactive_'.$order_item->id ];
                $query2->Data['unit_price'] = $app['POST']['unit_price_'.$order_item->id ];
                $query2->Data['quantity'] = $app['POST']['quantity_'.$order_item->id ];
		$stupidNumber = $query2->Data['unit_price'] * $query2->Data['quantity'];
		$query2->Data['total_price_tax_excl'] = $stupidNumber + 0.000000001;

		$query2->Update();
	}


		$tempItemToAddID = $app['POST']['ItemToAdd_ID'];
		$testPrice = $app['POST']['ItemToAdd_Price'];
		$testQty = $app['POST']['ItemToAdd_Qty'];


		if ($tempItemToAddID!="0" && $testQty !=0)
		{
		$insertnewItemQuery = new query('order_items');
                $insertnewItemQuery ->Data['order_id'] = $id;
                $insertnewItemQuery ->Data['customer_id'] = $app['POST']['ItemToAdd_customerID'];
                $insertnewItemQuery ->Data['product_id'] = $tempItemToAddID;
                $insertnewItemQuery ->Data['quantity'] = $testQty;
                $insertnewItemQuery ->Data['quantity_initial'] = 0;

                $insertnewItemQuery ->Data['unit_price'] = $testPrice ;
                $insertnewItemQuery ->Data['total_price_tax_excl'] = $testQty * $testPrice;
                $insertnewItemQuery ->Data['date_add'] = '1';
                $insertnewItemQuery ->insert();

		}



        $query_one = new query('order_items as oi');
        $query_one -> Field = "oi.*";
        $query_one->Where.= " where oi.order_id =$id AND oi.inactive=0";
        $orders_item = $query_one->ListOfAllRecords('object');
       $totalamount =0;

        foreach ($orders_item as $order_item)
	{
		$totalamount = $totalamount + $order_item->total_price_tax_excl;
	}


        $query->Data['grand_total'] = $totalamount;
	$query->Update();

	}


        $query= new query('orders'); 
        $query->Where = "where id =$id";
        $orders = $query->DisplayOne(); 

        $newquery = new query('users');
        $newquery->Where = " where id = $orders->user_id";
        $trust = $newquery->DisplayOne();

        $query_one = new query('order_items as oi');
        $query_one -> Field = "oi.*, b.batch_image as batch_image, b.level, b.id as batch_id, b.ribbon_name_en as batch_name,b.type as type,c.first_name as firstname,c.last_name as lastname, c.ShownName as ShownName,rl.name as location_name";
        $query_one->Where = " left join batches as b ON b.id = oi.product_id";
        $query_one->Where.= " left join customers as c ON c.id = oi.customer_id";
        $query_one->Where.= " left join ribbon_location as rl ON rl.id = oi.country";
        $query_one->Where.= " where oi.order_id =$id ORDER BY oi.customer_id, b.level, b.id";
        $orders_item = $query_one->ListOfAllRecords('object');


        $query= new query('order_items'); 
        $query -> Field = " customer_id, order_id, first_name, last_name ";
        $query->Where = " LEFT JOIN orders  ON orders.id=order_id LEFT JOIN customers ON customer_id=customers.id WHERE customer_id IN(Select id from customers WHERE user_id=$orders->user_id) AND orders.is_order_valid=1 AND order_id<>$id GROUP BY customer_id, order_id";
        $customer_order_items = $query->ListOfAllRecords('object');

        $query= new query('order_items'); 
        $query -> Field = " customer_id, first_name, last_name, ShownName ";
        $query->Where = " LEFT JOIN customers ON customers.id=order_items.customer_id WHERE order_items.order_id=$id GROUP BY customer_id";
        $customers_for_this_order = $query->ListOfAllRecords('object');

        $query = new query('deliveryconditions');
        $query->Where = " order by position";
        $deliveryconditions = $query->ListOfAllRecords('object');

        $query = new query('paymentconditions');
        $query->Where = " order by position";
        $paymentconditions = $query->ListOfAllRecords('object');


        $query = new query('districts');
        $query->Where = " where id=$trust->district";
        $district = $query->DisplayOne(); 
	

        $query = new query('sub_districts');
        $query->Where = " where id=$trust->subdistrict";
        $subdistrict = $query->DisplayOne(); 


        $query = new query('departments_new');
        $query->Where = " where id=$trust->department_new";
        $department = $query->DisplayOne(); 


        $query = new query('departments_new');
        $query->Where = " where id=$trust->department_new2";
        $department2 = $query->DisplayOne();

        $query= new query('orders'); 
        $query->Where = " where user_id = $orders->user_id AND is_shipment_made = 0 AND is_order_valid = 1 AND id!=$id";
        $otherunfinishedorders = $query->ListOfAllRecords('object'); 


    endswitch;
?>
